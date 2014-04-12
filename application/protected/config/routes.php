<?php
/**
 * @author Andre Linoge
 */

$routes = array(
    '/' => 'site/index',

    'news/<alias:.*?>' => 'news/show',
    'news' => 'news/index',

    'products/<category_alias:.*?>' => 'products/index',
    'product/<category_alias:\w+>/<product_alias:\w+>' => 'products/show',

    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>'
);