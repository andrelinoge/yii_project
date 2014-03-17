<?php
/**
 * @author Andriy Tolstokorov
 * @version 1.0
 */

class VkontakteAPI
{
    const URL_OAUTH_VK = 'https://oauth.vk.com/access_token';
    const URL_API_VK = 'https://api.vk.com/method/';
    const METHOD_GET_USER_INFO = 'users.get';
    const METHOD_GET_USER_CITY_INFO = 'places.getCityById';

    /** @var string */
    protected $_secret_key;
    /** @var string */
    protected $_app_id;
    /** @var string */
    protected $_access_token = NULL;
    /** @var integer */
    protected $_user_id = NULL;

    /**
     * @param string $app_id application id got from Vkontakte
     * @param string $secret_key secret key for application got from Vkontakte
     */
    public function __construct( $app_id, $secret_key )
    {
        $this->_app_id = $app_id;
        $this->_secret_key = $secret_key;
    }

    /**
     * @param string $code temporary code from Vkontakte after user`s log in
     * @param string $return_uri return url. Necessary for Vkontakte API
     * @return bool TRUE on success
     * @throws Exception on fail
     */
    public function retrieve_token( $code, $return_uri )
    {

        $request_url = self::URL_OAUTH_VK
            . '?client_id=' . $this->_app_id
            . '&code=' . $code
            . '&client_secret=' . $this->_secret_key
            . '&redirect_uri=' . $return_uri;

        $curl_handler = curl_init();
        curl_setopt( $curl_handler, CURLOPT_URL, $request_url );
        curl_setopt( $curl_handler, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt( $curl_handler, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec( $curl_handler );
        curl_close( $curl_handler );

        $response = json_decode( $response, TRUE );

        if ( isset( $response[ 'access_token' ] ) )
        {
            $this->set_access_token( $response[ 'access_token' ] );
            $this->set_user_id( $response[ 'user_id' ] );
            return $response[ 'access_token' ];
        }
        else
        {
            if ( isset( $response[ 'error_description' ] ) )
            {
                throw new Exception( $response[ 'error_description' ] );
            }
            else
            {
                throw new Exception( 'No token. Vk error' );
            }
        }
    }

    /**
     * @return array
     */
    public function retrieve_user_data()
    {
        $request_url = self::URL_API_VK . self::METHOD_GET_USER_INFO
            . '?uid='. $this->get_user_id()
            . '&fields=uid,first_name,last_name,photo_big,'
            . '&access_token=' . $this->get_access_token();

        $curl_handler = curl_init();
        curl_setopt( $curl_handler, CURLOPT_URL, $request_url );
        curl_setopt( $curl_handler, CURLOPT_CONNECTTIMEOUT, 2 );
        curl_setopt( $curl_handler, CURLOPT_RETURNTRANSFER, 1 );

        $response = curl_exec( $curl_handler );
        curl_close( $curl_handler );
        $user_data = json_decode( $response, TRUE );
        $user_data = $user_data['response'][0]; // get first result in response array


        return $user_data;
    }

    /**
     * @return null|string
     * @throws Exception
     */
    public function get_access_token()
    {
        if ( $this->_access_token === NULL ) {
            throw new Exception( 'access token is not set!' );
        } else {
            return $this->_access_token;
        }
    }

    /**
     * @param string $accessToken
     * @return mixed
     */
    public function set_access_token( $accessToken )
    {
        $this->_access_token = $accessToken;
        return $accessToken;
    }

    /**
     * @return int|null
     * @throws Exception
     */
    public function get_user_id()
    {
        if ( $this->_user_id === NULL ) {
            throw new Exception( 'access token is not set!' );
        } else {
            return $this->_user_id;
        }
    }

    /**
     * @param integer $userId
     * @return mixed
     */
    public function set_user_id( $userId )
    {
        $this->_user_id = $userId;
        return $userId;
    }

    /*
    'uid' => 17222393,
    'first_name' => 'Андрій',
    'last_name' => 'Толстокоров',
    'nickname' => '[-> Andre Linoge <-]',
    'sex' => 2,
    'bdate' => '6.3.1987',
    'city' => '2106',
    'country' => '2',
    'photo_big' => 'http://cs417316.userapi.com/v417316393/ed6/bEwlMqO-jTQ.jpg'
     */

    /* VK support such countries:

    {"cid":1,"title":"Россия"},
    {"cid":2,"title":"Украина"},
    {"cid":3,"title":"Беларусь"},
    {"cid":4,"title":"Казахстан"},
    {"cid":5,"title":"Азербайджан"},
    {"cid":6,"title":"Армения"},
    {"cid":7,"title":"Грузия"},
    {"cid":8,"title":"Израиль"},
    {"cid":9,"title":"США"},
    {"cid":65,"title":"Германия"},
    {"cid":11,"title":"Кыргызстан"},
    {"cid":12,"title":"Латвия"},
    {"cid":13,"title":"Литва"},
    {"cid":14,"title":"Эстония"},
    {"cid":15,"title":"Молдова"},
    {"cid":16,"title":"Таджикистан"},
    {"cid":17,"title":"Туркмения"},
    {"cid":18,"title":"Узбекистан"}

     */
}