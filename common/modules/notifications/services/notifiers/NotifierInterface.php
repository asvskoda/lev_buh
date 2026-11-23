<?php

declare(strict_types=1);

namespace common\modules\notifications\services\notifiers;

/**
 * Отправка служебных уведомлений сотрудникам
 */
interface NotifierInterface
{
    /**
     * Отправляет уведомление. Ошибки доставки логируются и не пробрасываются:
     * уведомление вспомогательное и не должно ломать основную операцию
     *
     * @param string $message текст без разметки
     *
     * @return bool доставлено ли уведомление хотя бы одному получателю
     */
    public function notify(string $message): bool;
}
