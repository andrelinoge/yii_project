<?php
/**
 * @author Andre Linoge
 */

$js_controllers_path = '/application/public/' . APPLICATION_END . '/js/controllers/';

$client_script_packages = [
    // 'jquery' => [
    //     'baseUrl'  => '/application/public/common/js/',
    //     'js'       => [ 'jquery-1.9.1.min.js', 'jquery-migrate-1.1.1.min.js' ],
    //     'position' => CClientScript::POS_HEAD
    // ],

    'form' => [
        'baseUrl'  => '/application/public/common/js/',
        'js'       => [ 'jquery.form.js' ],
        'position' => CClientScript::POS_END
    ],

    'validation' => [
        'baseUrl' => '/application/public/common/js/',
        'js'      => [ 'jquery.validate.js', 'additional-validators.min.js' ],
    ],

    'file_uploader' => [
        'baseUrl' => '/application/public/common/js/plugins/fileuploader/',
        'js'      => [ 'fileuploader.js' ],
        'css'     => [ 'fileuploader.css' ],
    ],

    'uploader' => [
        'baseUrl' => $js_controllers_path,
        'js'      => [ 'uploadController.js'],
        'depends' => [ 'file_uploader' ]
    ],

    'applicationEndController' => [
        'baseUrl' => $js_controllers_path,
        'js'      => [ 'applicationController.js' ],
    ],

    'ckEditor' => [
        'baseUrl' => '/application/public/common/js/plugins/ckeditor/',
        'js'      => [ 'ckeditor.js' ],
    ],

    'jeditable' => [
        'baseUrl' => '/application/public/backend/js/plugins/jeditable/',
        'js'      => [ 'jquery.jeditable.js' ],
    ],
];