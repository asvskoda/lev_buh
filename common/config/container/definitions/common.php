<?php
// phpcs:ignoreFile

declare(strict_types=1);

use common\modules\notifications\services\notifiers\NotifierInterface;
use common\modules\notifications\services\notifiers\TelegramNotifier;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

return array_merge(
    [
        // Без токена или чатов уведомления не уходят (notifier пишет warning), но заявки сохраняются:
        // ошибка конфигурации уведомлений не должна ронять форму
        NotifierInterface::class => static function (): NotifierInterface {
            $telegram = Yii::$app->params['telegram'] ?? [];

            $logHandler = new StreamHandler(Yii::getAlias('@runtime/logs/telegram.log'));
            $logHandler->setFormatter(new LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n"));

            return new TelegramNotifier(
                (string)($telegram['botToken'] ?? ''),
                (array)($telegram['chatIds'] ?? []),
                new Logger('telegram', [$logHandler]),
            );
        },
    ],

    require('subdefinitions/article.php'),

);
