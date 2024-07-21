<?php

return [
    'email' => [
        'host' => 'sandbox.smtp.mailtrap.io',
        'port' => 465,
        'username' => '',
        'password' => ''
    ],
    'login' => [
        'admin' => [
            'loggedIn' => 'admin_login',
            'redirect' => '/admin',
            'idLoggedIn' => 'id_admin'
        ],
        'user' => [
            'loggedIn' => 'user_login',
            'redirect' => '/',
            'idLoggedIn' => 'id_user'
        ]
    ]
];