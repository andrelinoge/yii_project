<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

/*
TODO: merge include those arrays in this config in production
*/

require_once 'routes.php'; // contains $routes
require_once 'params.php'; // contains $applicationParams
require_once 'packages.php'; // contains clientScript packages settings

$applicationDir = dirname( dirname ( dirname( __FILE__ ) ) );

if (APPLICATION_END == 'backend')
{
    $routes = [];
}

return [
	'basePath' => $applicationDir . '/protected',
    'runtimePath' => $applicationDir . '/public/runtime',
	'name' => 'Yii project',

	// preloading 'log' component
	'preload' => ['log', 'gettext'],

	// autoloading model and component classes
	'import' => array(
		'application.models.*',
        'application.forms.*',
        'application.mailers.*',
        'application.behaviors.*',
        'application.behaviors.model.*',

        // includes kernel and support classes
        'application.components.auth.*', // includes authorization components

        'application.components.core.*', // includes behaviors and overwritten components
        'application.components.helpers.*', // includes behaviors and overwritten components

        'application.lib.*',
        'application.components.vendor.*', // includes such components as ImageRoutine, PayPal, social API classes
        'application.components.vendor.twitter_oauth.*',

        // navigation
        'application.navigation.*',

        // widgets
        'application.widgets.*',
        // extensions
        'application.extensions.phpredis.*',

        // application models
	),

    // Set application behavior
    'behaviors' => [
        'runEnd'=> [ 'class'=>'application.behaviors.ApplicationEndBehavior' ]
    ],

	// application components
	'components' => [
        'assetManager' => [
            'basePath' => $applicationDir . '/public/assets',
            'baseUrl'  => '/application/public/assets/'
        ],

		'user' => [
			'allowAutoLogin' => TRUE, // enable cookie-based authentication
            'class' => 'WebUser', // located in components/system/ and is inherit for CWebUser
            'loginUrl' => 'site/login'
		],

        'authManager' => [
            'class' => 'phpAuthManager',
            'defaultRoles' => [ 'guest' ]
        ],

        // URLs
		'urlManager' => [
            'urlFormat' => 'path',
            'showScriptName' => false,
            'rules' => $routes
		],

        // DB
		'db' => [
            //local

            'connectionString' => 'mysql:host=localhost;dbname=test',
            'username' => 'root',
            'password' => 'root',

            'emulatePrepare' => true,
			'charset' => 'utf8',
            'schemaCachingDuration'=> 3600,
            'enableProfiling'       => TRUE,
            'enableParamLogging'    => TRUE
		],

        // Error
		'errorHandler' => [
			'errorAction'=>'site/error',
		],

        // Log
		'log' => [
			'class'=>'CLogRouter',
			'routes' => [
				[
					//'class'=>'CFileLogRoute',
                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute', // comment in production version
					'levels'=>'error, warning',
				]
			]
		],

        'gettext' => [
            'class' => 'ext.yii-gettext.GetText',
            'domain' => 'frontend'
        ],

        // Cache

        'cache' => [
            'class' => 'system.caching.CDummyCache',
            //'class' => 'system.caching.CMemCache',
            //'useMemcached' => TRUE, // use libmemcached library, written in C, to work with memcache server
        ],

        // Mail
        'mail' => [
            'class' => 'ext.yii-mail.YiiMail',
            'transportType' => 'smtp',
            'viewPath' => 'application.views.mailer',
            'logging' => true,
            'dryRun' => false,
            'transportOptions' => [
                'host' => 'ssl://smtp.gmail.com',
                'username' => 'name',
                'password' => 'pass',
                'port' => 465
            ],
        ],

        // ClientScript
        'clientScript' => [
            'class' => 'ClientScript',
            'packages' => $client_script_packages,
            'coreScriptPosition' => CClientScript::POS_END
        ],

        // Redis
        'redis' => [
            'class' => 'ext.phpredis.ARedisConnection',
            'hostname' => 'localhost',
            'port' => '6379'
        ]
    ],

	'params' => $application_params,
    // Locale settings
    'sourceLanguage' => 'uk_UA',
    'language' => 'en',
    'charset' => 'utf-8'
];
