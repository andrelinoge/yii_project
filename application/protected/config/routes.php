<?php
/**
 * @author Andre Linoge
 */

$routes = array(
    '/' => 'site/index',

    'toys/<catalog:.*?>/<tag:.*?>' => 'toys/show',
    'toys/<catalog:.*?>' => 'toys/index',
    'toys' => 'toys/index',

    'transport/<catalog:.*?>/<tag:.*?>' => 'transport/show',
    'transport/<catalog:.*?>' => 'transport/index',
    'transport' => 'transport/index',

    'furniture/show/<catalog:.*?>/<tag:.*?>' => 'furniture/show',
    'furniture/<catalog:.*?>' => 'furniture/index',
    'furniture' => 'furniture/index',

    'articles' => 'articles/index',
    'article/<tag:.*?>' => 'articles/show',

    'help' => 'page/help',
    'credit' => 'page/credits',
    'dostavka-i-oplata' => 'page/delivery',
    'garantiya' => 'page/help',
    'contacts' => 'contacts/new',

    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>'
);