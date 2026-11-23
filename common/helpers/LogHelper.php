<?php

declare(strict_types=1);

namespace common\helpers;

use Monolog\Formatter\LineFormatter;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * Логирование сообщений в файл
 */
final class LogHelper
{
    public static function writeInfo(string $message, string $filePath)
    {
        $handler = new StreamHandler($filePath, Logger::INFO);
        // context и extra не используются: без них в конце строки нет пустых "[] []"
        $handler->setFormatter(new LineFormatter("[%datetime%] %channel%.%level_name%: %message%\n"));

        $log = new Logger('info');
        $log->pushHandler($handler);
        $log->info($message);
    }
}
