<?php

declare(strict_types=1);

$params = array_merge(
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'ua',
    'sourceLanguage' => 'ua',
    'container' => [
        'definitions' => require(__DIR__ . '/container/definitions/common.php'),
        'singletons' => require(__DIR__ . '/container/singletons/common.php'),
    ],
    'components' => require(__DIR__ . '/components/common.php'),

    'params' => $params,
];
