<?php

return [
    'name' => 'Экзот: субтропические плодовые растения',
    'description' => 'Выращивание субтропических плодовых культур в домашних условиях. Статьи, рекомендации, ответы на часто задаваемые вопросы.',
    'logo_png' => '/images/ekzot.png',
    'url' => env('APP_URL'),
    'address' => env('APP_URL'),
    'admin' => [
        'mail' => 'audi@audiophilesoft.ru',
        'login' => 'Master'
    ],
    'registration' => [
        'confirmation' => [
            'address' => '/confirm_registration?key=',
            'key_length' => 24
        ]
    ],
    'articles' => [
        'url' => 'articles',
        'postfix' => '.html',
        'name' => 'Статьи',
        'catalogue_entries_limit' => 8
    ],
    'users' => [
        'avatar' => [
            'accept_mimes' => 'image/png,image/jpeg,image/gif',
            'accept_extensions' => 'png,jpeg,jpg,gif',
            'max_width' => 500,
            'max_height' => 500,
            'max_size' => 512,
            'path' => public_path(DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR . 'avatars'),
            'relative_path' => '/images/avatars/',
        ],

        'name' => [
            'min_length' => 3,
            'max_length' => 48,
            'regex' => '/^[A-Za-zА-Яа-яЁё]{1}[A-Za-zА-Яа-яЁё0-9\-\_ ]{0,}$/u',
        ],
        'password' => [
            'min_length' => 6,
            'max_length' => 255,
            'regex' => '/^[a-zA-Z0-9\.\-\_]+$/',
        ],
    ],
    'comments' => [
        'min_size' => '2',
        'max_size' => '4096',
        'check_period' => '5', // minutes
        'max_for_period' => '2'
    ],
    'home' => [
        'cat_to_show' => 'blog',
        'entries_limit' => 4
    ]
];