<?php
/**
 * @author Andre Linoge
 */

$js_controllers_path = '/application/public/' . APPLICATION_END . '/js/controllers/';

$client_script_packages = [
    'jquery' => [
        
        'baseUrl' => '/application/public/common/js/',
        'js' => [ 'jquery-1.9.1.min.js', 'jquery-migrate-1.1.1.min.js' ],
        'position' => CClientScript::POS_HEAD
    ],

    'form' => [
        'baseUrl' => '/application/public/common/js/',
        'js' => [ 'jquery.form.js' ],
        'depends' => [ 'jquery' ],
        'position' => CClientScript::POS_END
    ],

    'validation' => [
        'baseUrl' => '/application/public/common/js/',
        'js' => [ 'jquery.validate.js', 'additional-validators.min.js' ],
        'depends' => [ 'jquery', 'form' ],
    ],

    'file_uploader' => [
        'baseUrl' => '/application/public/common/js/plugins/fileuploader/',
        'js' => [ 'fileuploader.js' ],
        'css' => [ 'fileuploader.css' ],
        'depends' => [ 'jquery' ]
    ],

    'uploader' => [
        'baseUrl' => $js_controllers_path,
        'js' => [ 'uploadController.js'],
        'depends' => [ 'file_uploader' ]
    ],

    'applicationEndController' => [
        'baseUrl' => $js_controllers_path,
        'js' => [ 'applicationController.js' ],
        'depends' => [ 'jquery' ]
    ],

    'ckEditor' => [
        'baseUrl' => '/application/public/common/js/plugins/ckeditor/',
        'js' => [ 'ckeditor.js' ],
        'depends' => [ 'jquery' ]
    ],

    'jeditable' => [
        'baseUrl' => '/application/public/backend/js/plugins/jeditable/',
        'js' => [ 'jquery.jeditable.js' ],
        'depends' => [ 'jquery' ]
    ],

    'frontend' => [
        'baseUrl' => '/application/public/frontend/js/controllers/',
        'js' => [
            'applicationController.js', 'authorizationController.js'
        ],
        'depends' => [ 'jquery', 'form' ]
    ]
];