<?php
/**
 * @author Andre Linoge
 * Date: 11/17/12
 */

// Application configs like count items per page, emails, IDs etc.
$application_params = array(
    'cache_ttl' => 3600,

    'localization' => [
        'enabled' => true,
        'default' => 'ru',
        'available' => [
            'short_form' => [ 'ru', 'uk' ],
            'full_form' => [
                'uk' => 'uk_UA',
                'ru' => 'ru_RU'
            ],
            'with_descriptions' => [
                'ru' => 'Русский',
                'uk' => 'Українська'
            ]
        ]
    ],

    'adminIdentity' => [
        'email' => 'admin@mail.com',
        'password' => '1111',
        'first_name' => 'Andriy',
        'last_name' => 'Tolstokorov'
    ],

    'frontend' => [
        'items_per_page' => 3
    ],

    'backend' => [
        'items_per_page' => 10,
        'items_per_page_options' => [
            '5' => '5',
            '10' => '10',
            '20' => '20',
            '30' => '30',
            '50' => '50'
        ]
    ],

    'emails' => [
        'notification_sender'       => 'andrelinoge87@gmail.com',
        'admin'                     => 'andrelinoge87@gmail.com',
        'contact_messages_receiver' => 'andrelinoge87@gmail.com'
    ],

    'oAuth' => [
        'vk' => [
            'app_id' => '3998778',
            'secret_key' => '1IyGLG0vKlsTG6ue4U40'
        ],
        'fb' => [
            'app_id' => '468413143276793',
            'secret_key' => '5d4cc6653ef38166429899e7dbaa94ff'
        ],
        'twitter' => [
            'app_id' => 'pMTz11ZCiG1zbtS40kYA',
            'secret_key' => '3D2hxwmBPTZPlcYAM6cRhgxF6MvkWcjgKplxJBxOFY'
        ]
    ]

);