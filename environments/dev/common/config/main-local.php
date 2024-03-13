<?php

use yii\db\Connection;

return [
    'components' => [
        'db' => [
            'class' => Connection::class,
            'dsn' => 'pgsql:host=lev-db;port=5432;dbname=lev_db',
            'username' => 'postgres',
            'password' => 'a4&_GH1tR67',
            'charset' => 'utf8',
            'on afterOpen' => function ($event) {
                $event->sender->createCommand("SET timezone to 'Europe/Minsk';")->execute();
            }
        ],
    ],
];