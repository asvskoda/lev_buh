<?php

declare(strict_types=1);

namespace common\modules\notifications\services\notifiers;

interface NotifierInterface
{
    public function notify(string $message): void;
}
