<?php
/**
 * @author Andre Linoge
 */

$routes = array(
    '/' => 'site/index',

    'articles/<category_alias:.*?>' => 'articles/index',
    'article/<category_alias:.*?>/<article_alias:.*?>' => 'articles/show',

    'faq' => 'page/faq',
    'about' => 'page/about',
    'contacts' => 'contactUs/new',

    '<controller:\w+>/<action:\w+>'=>'<controller>/<action>'
);