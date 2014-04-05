<?php

class UrlManager extends CUrlManager
{
    public function createUrl($route, $params=array(), $ampersand='&')
    {
        return $this->_fix_path_slashes(parent::createUrl($route, $params, $ampersand));
    }
 
    protected  function _fix_path_slashes($url)
    {
        return preg_replace('|\%2F|i', '/', $url);
    }
}