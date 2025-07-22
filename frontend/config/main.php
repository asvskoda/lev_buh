<?php

use yii\helpers\ArrayHelper;
use frontend\modules\admin\AdminModule;
use frontend\modules\main\MainModule;
use yii\i18n\PhpMessageSource;
use yii\web\JsonResponseFormatter;
use frontend\language\dispatcher\UserHandler;
use frontend\language\dispatcher\LanguageCookieHandler;
use yii\log\FileTarget;
use yii\caching\FileCache;
use frontend\components\LanguageDispatcherComponent;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'language' => 'uk',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => ArrayHelper::merge(
        require __DIR__ . '/../../common/config/components/common.php',
        [
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => PhpMessageSource::class,
                    'basePath' => '@frontend/messages',
                    'sourceLanguage' => 'uk',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],
        'request' => [
            'cookieValidationKey' => 'MyJesusIsLord',
            'enableCsrfValidation' => false,
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
                'text/xml' => 'yii\web\XmlParser',
            ],
        ],
        'response' => [
            'formatters' => [
                'json' => [
                    'class' => JsonResponseFormatter::class,
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
            'loginUrl' => ['admin/auth/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
            'cookieParams' => [
                'path' => '/',
                'domain' => '',
            ],
        ],
        'cache' => [
            'class' => FileCache::class,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => FileTarget::class,
                    'levels' => ['error', 'warning','info'],
                    'logVars' => [],
                    'logFile' => '@runtime/logs/app.log',
                ],
            ],
        ],

        'errorHandler' => ['errorAction' => 'main/home/error'],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'main/home/index',
                'contact' => 'main/contact/index',
                'about' => 'main/about/index',
                'serve' => 'main/serve/index',
                'price' => 'main/price/index',
                'testimonial' => 'main/testimonial/index',
                'consulting' => 'admin/consulting/index',
                'article' => 'admin/article/index',
                'admin' => 'admin/admin/index',
            ],
        ],
    ]),
    'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '172.19.0.1'],
        ],
        'gii' => [
            'class' => '\yii\gii\Module',
            //'allowedIPs' => ['127.0.0.1', '::1'],
        ],
        'main' => [
            'class' => MainModule::class,
            'layout' => '@frontend/modules/main/views/layouts/main'
        ],
        'admin' => [
            'class' => AdminModule::class,
            'layout' => '@frontend/modules/admin/views/layouts/main'
        ],
    ],
    'params' => $params,
    'on beforeRequest' => function () {
        $languages = ['uk', 'ru'];
        $language = Yii::$app->request->get('lang', null);

        if ($language && in_array($language, $languages)) {
            Yii::$app->language = $language;
            Yii::$app->session->set('language', $language);
        } elseif (Yii::$app->session->has('language')) {
            Yii::$app->language = Yii::$app->session->get('language');
        } else {
            $preferredLanguage = Yii::$app->request->getPreferredLanguage($languages);
            Yii::$app->language = $preferredLanguage ?: 'uk';
            Yii::$app->session->set('language', Yii::$app->language);
        }
    },
];
