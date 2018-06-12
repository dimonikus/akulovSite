<?php

if (strripos($_SERVER['SERVER_NAME'], '.local') == true || strripos(__DIR__, '.local') == true) {
    return [
        'class' => 'yii\db\Connection',
        'dsn' => 'mysql:host=localhost;dbname=shark',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
    ];
}

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=shark',
    'username' => 'u_shark',
    'password' => 'Stt0zd1L',
    'charset' => 'utf8',
];
