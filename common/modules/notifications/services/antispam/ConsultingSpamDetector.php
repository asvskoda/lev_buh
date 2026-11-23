<?php

declare(strict_types=1);

namespace common\modules\notifications\services\antispam;

use frontend\modules\main\forms\ContactForm;

/**
 * Признаки спама в заявке на консультацию
 */
final class ConsultingSpamDetector
{
    /** Быстрее человек форму не заполнит */
    private const MIN_FILL_SECONDS = 3;

    private const LINK_PATTERN = '~https?://|www\.|\[url|<a\s~iu';
    private const NAME_PATTERN = '~^[\p{L}\p{M}\s\'’ʼ`.,"«»()\-]+$~u';
    private const CYRILLIC_PATTERN = '~\p{Cyrillic}~u';
    /** ContactForm приводит украинские номера к этому виду */
    private const UA_PHONE_PATTERN = '~^\+380\d{9}$~';

    /**
     * Возвращает причину, по которой заявка признана спамом, или null
     */
    public function detect(ContactForm $form, int $formAgeSeconds): ?string
    {
        if (trim((string)$form->website) !== '') {
            return 'honeypot filled';
        }

        if ($formAgeSeconds < self::MIN_FILL_SECONDS) {
            return "form submitted too fast ({$formAgeSeconds}s)";
        }

        foreach (['name', 'phone', 'question'] as $attribute) {
            if (preg_match(self::LINK_PATTERN, (string)$form->$attribute)) {
                return "link in {$attribute}";
            }
        }

        if (!preg_match(self::NAME_PATTERN, (string)$form->name)) {
            return 'invalid characters in name';
        }

        if (!preg_match(self::CYRILLIC_PATTERN, (string)$form->question)) {
            return 'question without cyrillic';
        }

        if (!preg_match(self::UA_PHONE_PATTERN, (string)$form->phone)) {
            return 'non-ukrainian phone';
        }

        return null;
    }
}
