<?php

return [
    'components' => [
        'db' => [
            'class' => \yii\db\Connection::class,
            'dsn' => 'mysql:host=db;port=5432;dbname=lev_db',
            'username' => 'postgres',
            'password' => '',
            'charset' => 'utf8',
            'on afterOpen' => function ($event) {
                $event->sender->createCommand("SET timezone to 'Europe/Minsk';")->execute();
            }
        ],
    ],
];
