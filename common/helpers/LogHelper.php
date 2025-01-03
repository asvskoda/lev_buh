<?php

declare(strict_types=1);

namespace common\helpers;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Логирование сообщений в файл
 */
final class LogHelper
{
    public static function writeInfo(string $message, string $filePath)
    {
        $log = new Logger('info');
        $log->pushHandler(new StreamHandler($filePath, Logger::INFO));
        $log->info($message);
    }
}
