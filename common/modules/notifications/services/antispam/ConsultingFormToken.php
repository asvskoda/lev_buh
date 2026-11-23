<?php

declare(strict_types=1);

namespace common\modules\notifications\services\antispam;

use Yii;

/**
 * Подписанная метка времени показа формы консультации.
 * Бот, отправляющий POST напрямую без загрузки страницы, валидной метки не имеет
 */
final class ConsultingFormToken
{
    private string $secret;

    public function __construct()
    {
        $this->secret = (string)Yii::$app->request->cookieValidationKey;
    }

    public function issue(): string
    {
        return Yii::$app->security->hashData((string)time(), $this->secret);
    }

    /**
     * Сколько секунд прошло с показа формы; null — метка отсутствует или подделана
     */
    public function ageInSeconds(string $token): ?int
    {
        if ($token === '') {
            return null;
        }

        $issuedAt = Yii::$app->security->validateData($token, $this->secret);

        if ($issuedAt === false || !ctype_digit($issuedAt)) {
            return null;
        }

        return time() - (int)$issuedAt;
    }
}
