<?php
/**
 * This file contains global function - shortcuts to reduce typing
 */

/**
 * This is the shortcut to Yii::t with default category 'site'
 */
function t( $message, $category = 'site', $params = array(), $source = NULL, $language = NULL )
{
    return Yii::t( $category, $message, $params, $source, $language );
}

/**
 * This is the shortcut to Yii::Yii::app()->request()->getParam() with default value NULL
 */
function get_param( $key, $default = NULL )
{
    return Yii::app()->request->getParam( $key, $default );
}

/**
 * This is the shortcut to Yii::Yii::app()->createAbsoluteUrl()
 */
function url( $route, $params = array() )
{
    return Yii::app()->createAbsoluteUrl( $route, $params );
}

/**
 * This is the shortcut to Yii::Yii::app()->createUrl()
 */
function assets_folder( $path = '/application/public' )
{
    return Yii::app()->request->baseUrl . $path;
}

/**
 * check if request is ajax
 * @return bool
 */
function is_ajax()
{
    return Yii::app()->request->isAjaxRequest || isset( $_GET[ 'ajax' ] ) || isset( $_POST[ 'ajax' ] );
}

/**
 * This function check if request is AJAX or POST
 * @return bool
 */
function is_post_or_ajax()
{
    return Yii::app()->request->isPostRequest || is_ajax();
}

/**
 * @return User
 */
function current_user()
{
    if (Yii::app()->user)
    {
        return Yii::app()->user->get_model();
    }
    return NULL;
}

/**
 * return response for ajax request with 'status = true' and additional params
 * like successMessage or redirect url
 * @param $response mix
 */
function success( $message = '', $data = array() )
{
    if (is_ajax())
    {
        $data['success'] = true;
        $data['message'] = $message;
        echo CJSON::encode( $data );
    }
    else
    {
        Yii::app()->user->setFlash('success', $message);
    }
}

/**
 * return response for ajax request with 'status = false' and additional params
 * like errorMessage
 * @param array $response
 */
function failure( $message = '', $data = array() )
{
    if (is_ajax())
    {
        $data['success'] = false;
        $data['message'] = $message;
        echo CJSON::encode( $data );
    }
    else
    {
        Yii::app()->user->setFlash('error', $message);
    }
}

function debug($var)
{
    var_export($var);
    exit();
}