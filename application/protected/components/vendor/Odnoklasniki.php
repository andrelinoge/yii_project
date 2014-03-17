<?php

class Odnoklassniki 
{
    const AUTH_URL = 'http://www.odnoklassniki.ru/oauth/authorize';
    const TOKEN_URL = 'http://api.odnoklassniki.ru/oauth/token.do?';
    const API_URL = 'http://api.odnoklassniki.ru/fb.do?'; 
    
    
    protected $connection_data = array();

    /*
     * Редирект урл
     */
    protected $redirect_url = '';

    /*
     * Токены для доступа
     */
    protected $token = array();

    /*
     * Конструктор
     */
    public function __construct($connection_data = array()) 
    {
        $this->connection_data = $connection_data;
    }

    /*
     * Установить редирект урл 
     */
    public function set_redirect_url($url = '') {
        $this->redirect_url = $url;
    }

    /*
     * Получить ссылку для подключения
     */
    public function getLoginUrl($scope = array())
    {
        return self::AUTH_URL . '?'
        . http_build_query(
            array(
                'client_id'     => $this->connection_data['client_id'],
                'response_type' => 'code',
                'redirect_uri'  => $this->redirect_url,
                'scope' => implode(';', $scope)
            )
        );
    }

    /*
     * Выбросить ошибку
     */
    public function error($array) {
        throw new Exception($array['error'] . ':' . (isset($array['error_description']) ? $array['error_description'] : ''));
    }

    /*
     * Выставить токен
     */
    public function setToken($token) {
        if(is_string($token)) {
            $token = json_decode($token, true);
        }
        $this->token = $token;
    }

    /*
     * Получить строку токена
     */
    public function getTokenStr() {
        return json_encode($this->token);
    }

    /*
     * Получить токен
     */
    public function getToken($code = '') {
        if($code) {
            $this->token = $this->sendRequest(
                $this->token_url,
                array(
                    'code' => $code,
                    'redirect_uri' => $this->redirect_url,
                    'grant_type' => 'authorization_code',
                    'client_id' => $this->connection_data['client_id'],
                    'client_secret' => $this->connection_data['client_secret']
                )
            );
            if(isset($this->token['error'])) {
                $this->error($this->token);
            } else {
                $this->token['expires'] = time() + 30 * 60; // Маркер доступа имеет ограниченное время существования - 30 минут
            }
        }
    }

    /*
     * Обновить токен
     */
    public function refreshToken() {
        $this->token = $this->sendRequest(
            $this->token_url,
            array(
                'refresh_token' => $this->token['refresh_token'],
                'grant_type' => 'refresh_token',
                'client_id' => $this->connection_data['client_id'],
                'client_secret' => $this->connection_data['client_secret']
            )
        );
        if(isset($this->token['error'])) {
            $this->error($this->token);
        }
    }

    /*
     * Получить аксес токен
     */
    public function getAccessToken() {
        if(isset($this->token['access_token'])) {
            if(isset($this->token['expires']) && $this->token['expires'] < time()) {
                $this->refreshToken();
            }
            return $this->token['access_token'];
        }
        return false;
    }

    /*
     * Обратиться к апи 
     */
    public function api($action = '', $parameters = array(), $method='POST') {
        $accessToken = $this->getAccessToken();
        $paramsArray = array(
            'application_key=' . $this->connection_data['application_key'],
            'method=' . $action
        );
        foreach($parameters as $k => $v) {
            $paramsArray[] = $k . '=' . urlencode($v);
        }
        sort($paramsArray);
        $sig = md5(
            implode("", $paramsArray)
            . md5(
                $accessToken
                . $this->connection_data['client_secret']
            )
        );
        $paramsArray[] = 'access_token=' . $accessToken;
        $paramsArray[] = 'sig=' . $sig;
        sort($paramsArray);
        return $this->sendRequest(
            $this->api_url,
            implode("&", $paramsArray),
            $method
        );
    }

    /*
     * Отправить реквест
     */
    protected function sendRequest($url = '', $params = array(), $method = 'POST') {
        if(is_array($params)) {
            $params = http_build_query($params);
        }
        $ch = curl_init();
        if($method == 'GET') {
            $url .= $params;
        } else if($method == 'POST') {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $result = curl_exec($ch);
        curl_close($ch);
        return json_decode($result, true);
    }
}
?>