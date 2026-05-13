<?php
// phpcs:ignoreFile

declare(strict_types=1);

use common\modules\notifications\services\notifiers\NotifierInterface;
use common\modules\notifications\services\notifiers\TelegramNotifier;

//use GuzzleHttp\Client;
//use GuzzleHttp\ClientInterface;

return array_merge(
    [
        NotifierInterface::class => function () {
            $tg = Yii::$app->params['telegram'] ?? [];

            $chatIds = array_map('intval', (array)($tg['chatIds'] ?? []));
            $chatIds = array_values(array_unique(array_filter($chatIds)));

            return new TelegramNotifier(
                (string)($tg['botToken'] ?? ''),
                $chatIds
            );
        },

        //ClientInterface::class => Client::class,
    ],

    require('subdefinitions/article.php'),

);