<?php
/**
 * User: andrelinoge
 * Date: 11/13/13
 */

class SocialAuthorizationController extends ApplicationController
{

    public function actionTwitter()
    {
        /** @var CHttpSession $session */
        $session = app()->session;
        $twitter_options = app()->params[ 'oAuth' ][ 'twitter' ];
        try
        {
            $got_keys_and_tokens = !empty($_GET['oauth_verifier']) && !empty($session['oauth_token']) && !empty($session['oauth_token_secret']);

            if (!$got_keys_and_tokens)
            {
                $twitter_oauth = new TwitterOAuth($twitter_options['app_id'], $twitter_options['secret_key']);
                $request_token = $twitter_oauth->getRequestToken(createUrl('socialAuthorization/twitter'));

                $session->add('oauth_token', $request_token['oauth_token']);
                $session->add('oauth_token_secret', $request_token['oauth_token_secret']);

                if ($twitter_oauth->http_code == TwitterOAuth::SUCCESS)
                {
                    $callback_url = $twitter_oauth->getAuthorizeURL($request_token['oauth_token']);
                    header('Location: '. $callback_url);
                }
                else
                {
                    throw new CException();
                }
            }
            else
            {
                $twitter_oauth = new TwitterOAuth($twitter_options['app_id'], $twitter_options['secret_key'], $session->get('oauth_token'), $session->get('oauth_token_secret'));
                $access_token = $twitter_oauth->getAccessToken($_GET['oauth_verifier']);
                $session->add('access_token', $access_token);
                $user_info = $twitter_oauth->get('account/verify_credentials');

                if ($user_info)
                {
                    $user_identity = new TwitterUserIdentity($user_info->id);
                    $user_identity->auth();

                    if ( $user_identity->errorCode === TwitterUserIdentity::ERROR_ID_NOT_FOUND )
                    {
                        if ( !$this->create_twitter_user( $user_info ) )
                        {
                            throw new CException();
                        }
                    }
                    else
                    {
                        if ( !$this->login( $user_identity ) )
                        {
                            // strange error: there is record in DB but can't log in
                            throw new CException();
                        }
                    }
                }
                else
                {
                    throw new CException();
                }
                echo '<script>window.close();</script>';
            }
        }
        catch ( Exception $e )
        {
            app()->user->setFlash('error', 'Произошла ошибка. Попробуйте еще​раз');
            app()->end();
        }
    }

    protected function create_twitter_user( $user_data )
    {
        $user = new User();
        $user->password = '';
        $user->email = '';
        $name = explode(' ', $user_data->name);
        $user->first_name = isset($name[0]) ? $name[0] : 'not set';
        $user->last_name = isset($name[1]) ? $name[1] : 'not set';

        if ( $user->save() )
        {
            $reflection = new TwitterUser();
            $reflection->user_id = (int)$user->id;
            $reflection->social_id = (int)$user_data->id;
            $reflection->save();

            if ( !empty( $user_data->profile_image_url ) )
            {
                $this->retrieve_user_photo( $user, $user_data->profile_image_url );
                $user->save();
            }

            User::refresh_cache( $user->id );

            $user_identity = new TwitterUserIdentity( $reflection->social_id );
            $user_identity->auth();

            return $this->login( $user_identity );
        }
        else
        {
            return FALSE;
        }
    }

    public function actionVk()
    {
        if ( isset( $_GET[ 'code' ] ) )
        {
            $vk_options = app()->params[ 'oAuth' ][ 'vk' ];
            $api = new VkontakteAPI( $vk_options[ 'app_id'], $vk_options[ 'secret_key'] );

            try
            {
                $api->retrieve_token( $_GET[ 'code' ], createUrl( 'socialAuthorization/vk' ) );
                $user_identity = new VkUserIdentity( $api->get_user_id() );
                $user_identity->auth();

                if ( $user_identity->errorCode === VkUserIdentity::ERROR_VK_ID_NOT_FOUND )
                {
                    if ( !$this->create_vk_user( $api->retrieve_user_data() ) )
                    {
                        throw new CException();
                    }
                }
                else
                {
                    if ( !$this->login( $user_identity ) )
                    {
                        // strange error: there is record in DB but can't log in
                        throw new CException();
                    }
                }
            }
            catch( Exception $e )
            {
                // fail on retrieving token - code is invalid or expired
                // show  some notice

                app()->user->setFlash('error', 'Произошла ошибка. Попробуйте еще​раз');
                app()->end();
            }
        }
        else
        {
            //throw new CException( 'VK does not response' );
            app()->user->setFlash('error', 'Произошла ошибка. Попробуйте еще​раз');
        }
    }

    protected function create_vk_user( $user_data )
    {
        $user = new User();
        $user->password = '';
        $user->email = '';
        $user->first_name = $user_data[ 'first_name'];
        $user->last_name = $user_data[ 'last_name'];

        if ( $user->save() )
        {
            $reflection = new VkontakteUser();
            $reflection->user_id = (int)$user->id;
            $reflection->social_id = (int)$user_data[ 'uid' ];
            $reflection->save();

            if ( isset( $user_data[ 'photo_big' ] ) && !empty( $user_data[ 'photo_big' ] ) )
            {
                $this->retrieve_user_photo( $user, $user_data[ 'photo_big' ] );
                $user->save();
            }

            User::refresh_cache( $user->id );

            $user_identity = new VkUserIdentity( $reflection->social_id );
            $user_identity->auth();

            return $this->login( $user_identity );
        }
        else
        {
            return FALSE;
        }
    }

    public function actionFb()
    {
        if ( is_ajax() )
        {
            $facebook = new Facebook(
                array(
                    'appId'  => app()->params[ 'oAuth' ][ 'fb' ][ 'app_id' ],
                    'secret' => app()->params[ 'oAuth' ][ 'fb' ][ 'secret_key' ],
                )
            );

            $facebook->setAccessToken( get_param( 'access_token') );
            try
            {
                $user_data = $facebook->api('/me' );

                $user_identity = new FbUserIdentity( $user_data[ 'id' ] );
                $user_identity->auth();


                if ( $user_identity->errorCode === FbUserIdentity::ERROR_FB_ID_NOT_FOUND )
                {
                    if ( !$this->bind_user_to_fb_by_email( $user_data ) )
                    {
                        $user_photo = $facebook->api(
                            '/' . $user_data[ 'id' ] . '/picture',
                            array(
                                'redirect' => false,
                                'width' => 540,
                                'height' => 540
                            )
                        );

                        $got_photo = is_array( $user_photo ) &&
                            isset( $user_photo[ 'data' ] ) &&
                            isset( $user_photo[ 'data' ][ 'url' ] );

                        if ( $got_photo )
                        {
                            $user_data[ 'photo_url'] = $user_photo[ 'data' ][ 'url' ];
                        }

                        if ( !$this->create_fb_user( $user_data ) )
                        {
                            throw new CException();
                        }
                    }
                    else
                    {
                        $user_identity = new FbUserIdentity( $user_data[ 'id' ] );
                        $user_identity->auth( $user_data );

                        if ( !$this->login( $user_identity ) )
                        {
                            // strange error: there is record in DB but can't log in
                            throw new CException();
                        }
                    }
                }
                else
                {
                    if ( !$this->login( $user_identity ) )
                    {
                        // strange error: there is record in DB but can't log in
                        throw new CException();
                    }
                }
            }
            catch ( Exception $e )
            {
                echo $e->getMessage();
                $this->unsuccessful_ajax_response(array(
                    'error_message' => 'Произошла ошибка. Попробуйте еще ​​раз.'
                ));
            }

            $this->successful_ajax_response(array(
                'redirect' => $this->createUrl('site/index')
            ));
        }
    }

    protected function create_fb_user( $user_data )
    {
        $user = new User();
        $user->first_name = isset( $user_data[ 'first_name'] ) ? $user_data[ 'first_name'] : '';
        $user->last_name = isset( $user_data[ 'last_name'] ) ? $user_data[ 'last_name'] : '';
        $user->password = '';
        $user->email = isset( $user_data[ 'email' ] ) ? $user_data[ 'email' ] : '';

        if ( $user->save() )
        {
            $reflection = new FacebookUser();
            $reflection->user_id = (int)$user->id;
            $reflection->social_id = (int)$user_data[ 'id' ];
            $reflection->save();

            if ( isset( $user_data[ 'photo_url'] ) && !empty( $user_data[ 'photo_url'] ) )
            {
                $this->retrieve_user_photo( $user, $user_data[ 'photo_url'] );
                $user->save();
            }

            User::refresh_cache( $user->id );

            $user_identity = new FbUserIdentity( $reflection->social_id );
            $user_identity->auth();

            return $this->login( $user_identity );
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * @param CUserIdentity $userIdentity
     * @return bool
     */
    protected function login( CUserIdentity $user_identity )
    {
        if( $user_identity->errorCode === CUserIdentity::ERROR_NONE )
        {
            $duration = 3600 * 24 * 30;
            app()->user->login( $user_identity, $duration );
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * @param int $user_id
     * @param string $image_url
     * @return bool
     */
    protected function retrieve_user_photo(User &$user, $image_url )
    {
        $file_name = explode( '/', $image_url );
        $file_name = array_pop( $file_name );

        $temp_file = $user->get_temp_folder(true) . $file_name;

        if ( copy( $image_url, $temp_file ) )
        {
            $user->image = $file_name;
            if ($user->save_image())
            {
                $user->photo = $file_name;
            }
        }
        else
        {
            return FALSE;
        }
    }

    protected function bind_user_to_fb_by_email( $user_data )
    {
        if ( isset( $user_data[ 'email' ] ) )
        {
            $user = User::model()->findByAttributes( array( 'email' => $user_data[ 'email' ] ) );
            if ( $user )
            {
                $reflection = new FacebookUser();
                $reflection->user_id = (int)$user->id;
                $reflection->social_id = (int)$user_data[ 'id' ];
                $reflection->save();

                return TRUE;
            }
        }

        return FALSE;
    }
} 