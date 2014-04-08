<?php
/**
 * @author Andre Linoge
 */

$routes = array(
    '/' => 'site/index',

    'news/<alias:.*?>' => 'news/show',
    'news' => 'news/index',

    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>'
);