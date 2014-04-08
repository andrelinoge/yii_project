<?php
/**
 * @author Andre Linoge
 */

return CMap::mergeArray(
    require(dirname(__FILE__).'/main.php'),

    [
        'preload' => ['bootstrap'],

        // Application modules
        'modules' => [
            'gii' => [
                'class' => 'system.gii.GiiModule',
                'password' => '1111',
                'ipFilters' => [ '127.0.0.1','::1' ]
            ]
        ],

        'components' => [
            'user' => [
                'allowAutoLogin' => FALSE,
                'class' => 'WebUser',
                'loginUrl' => '/backend.php/site/login'
            ],

            'urlManager' => [
                'urlFormat' => 'path',
                'showScriptName' => TRUE
            ],

            'gettext' => [
                'class' => 'ext.yii-gettext.GetText',
                'domain' => 'backend'
            ],

            'errorHandler' => [
                'errorAction' => 'site/error'
            ],

            'bootstrap' => [
                'class'        => 'ext.bootstrap.components.Bootstrap',
                'coreCss'      => false,
                'bootstrapCss' => false,
                'yiiCss'       => false
            ],
        ],

        'import' => [
            'application.controllers.backend.*'
        ]
    ]
);