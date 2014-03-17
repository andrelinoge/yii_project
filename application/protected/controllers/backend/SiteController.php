<?php

class SiteController extends BackendController
{
	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionError()
	{
        if (!current_user() || !current_user()->is_admin())
        {
            $this->redirect(Yii::app()->getBaseUrl(TRUE));
        }

        $error = Yii::app()->errorHandler->error;
		if($error)
		{
			if(is_ajax())
            {
                failure( ['message' => $error['message'] ]);
            }
			else
            {
                $this->render('error', $error);
            }
		}
	}

	public function actionLogin()
	{
		$model = new LoginForm();
        $this->set_layout( 'login-backend' );

        if ( is_post_or_ajax() )
        {
            if ( isset( $_POST[ 'LoginForm' ] ) )
            {
                $model->attributes = $_POST[ 'LoginForm' ];

                if ( $model->validate() )
                {
                    $model->login();
                }

                if ( is_ajax() )
                {
                    if ( $model->hasErrors() )
                    {
                        failure('wrong username/password', [ 'errors' => $model->getErrors() ]);
                    }
                    else
                    {
                        if ( Yii::app()->user->returnUrl )
                        {
                            $response[ 'redirect' ] = Yii::app()->user->returnUrl;
                        }
                        else
                        {
                            $response[ 'redirect' ] = $this->createUrl( 'index' );
                        }
                        success( '', $response );
                    }
                }
            }
        }
        else
        {
            $this->render( 'login', [ 'model' => $model ] );
        }
	}


    public function actionAddDefAdmin( $email = NULL )
    {
        $admin = new User();
        $admin->role = WebUser::ROLE_ADMIN;
        $admin->password = '1111';
        $admin->first_name = 'admin';
        $admin->last_name = 'admin';

        $admin->email = ( empty( $email ) ) ? 'admin@mail.com' : $email;

        try
        {
            $admin->save();
            echo 'login: ' . $admin->email . '<br> pass: 1111';
        }
        catch(Exception $e )
        {
        }
    }

    public function actionRemoveDefAdmin( $email = NULL )
    {
        $model = User::model()->findAllByAttributes( array( 'email' => ( empty( $email ) ) ? 'admin@mail.com' : $email ) );
        if ( $model )
        {
            $model->delete();
        }
    }

	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

    public function filters()
    {
        return [ 'accessControl' ];
    }

    public function accessRules()
    {
        return [
            [
                'allow',
                'actions' => [ 'index' ],
                'roles' => [ 'admin' ]
            ],

            [
                'allow',
                'actions' => [ 'error', 'changeLocale', 'login', 'addDefAdmin', 'removeDefAdmin' ],
                'users' => [ '*' ]
            ],

	        [
                'allow',
                'actions' => [ 'logout' ],
                'users' => ['@']
            ],

            [
                'deny',
                'users' => ['*']
            ]
        ];
    }
}
