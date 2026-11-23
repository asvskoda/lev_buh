<?php

declare(strict_types=1);

namespace common\modules\notifications\services;

use common\helpers\LogHelper;
use common\modules\notifications\exceptions\ConsultingRequestRejectedException;
use common\modules\notifications\models\ConsultingRequest;
use common\modules\notifications\services\antispam\ConsultingFormToken;
use common\modules\notifications\services\antispam\ConsultingRateLimiter;
use common\modules\notifications\services\antispam\ConsultingSpamDetector;
use common\modules\notifications\services\notifiers\NotifierInterface;
use frontend\modules\main\forms\ContactForm;
use Yii;
use yii\db\Exception;
use yii\db\Expression;
use yii\helpers\HtmlPurifier;

final class ConsultingService
{
    /** Повторная заявка с тем же телефоном или email за этот период не сохраняется */
    private const DUPLICATE_INTERVAL = '1 day';

    private NotifierInterface $notifier;
    private ConsultingRateLimiter $rateLimiter;
    private ConsultingFormToken $formToken;
    private ConsultingSpamDetector $spamDetector;

    public function __construct(
        NotifierInterface $notifier,
        ConsultingRateLimiter $rateLimiter,
        ConsultingFormToken $formToken,
        ConsultingSpamDetector $spamDetector
    ) {
        $this->notifier     = $notifier;
        $this->rateLimiter  = $rateLimiter;
        $this->formToken    = $formToken;
        $this->spamDetector = $spamDetector;
    }

    /**
     * @throws ConsultingRequestRejectedException заявку нужно отклонить с сообщением пользователю
     * @throws \Exception
     */
    public function notification(ContactForm $form): void
    {
        $ip = (string)($form->ip ?? '');

        $this->createLog('CONSULT notification called. URI=' . Yii::$app->request->url . ' METHOD=' . Yii::$app->request->method);

        if (!$this->rateLimiter->attempt($ip)) {
            $this->createLog("Rate limit exceeded, ip - {$ip}");
            throw new ConsultingRequestRejectedException(
                Yii::t('app', 'Ви вже надіслали запит. Спробуйте ще раз через кілька хвилин')
            );
        }

        $formAge = $this->formToken->ageInSeconds((string)$form->formToken);

        if ($formAge === null) {
            $this->createLog("Invalid form token, ip - {$ip}, " . $this->formToJson($form));
            throw new ConsultingRequestRejectedException(
                Yii::t('app', 'Сторінка застаріла. Оновіть її та надішліть форму ще раз')
            );
        }

        $spamReason = $this->spamDetector->detect($form, $formAge);

        if ($spamReason !== null) {
            $this->createLog("Spam rejected: {$spamReason}, ip - {$ip}, " . $this->formToJson($form));
            return;
        }

        if ($this->isDuplicate($form)) {
            $this->createLog("Duplicate request skipped, ip - {$ip}, " . $this->formToJson($form));
            return;
        }

        try {
            $this->save($form);

            $this->notifier->notify($this->buildTelegramMessage($form));
        } catch (\Throwable $exception) {
            $this->createLog('Error save/notify ' . $exception->getMessage());
            throw new \Exception(Yii::t('app', 'Вибачте виникла помилка'));
        }
    }

    private function isDuplicate(ContactForm $form): bool
    {
        return ConsultingRequest::find()
            ->where([
                'or',
                ['phone' => trim(strip_tags((string)$form->phone))],
                ['email' => filter_var((string)$form->email, FILTER_SANITIZE_EMAIL)],
            ])
            ->andWhere(['>=', 'created_at', new Expression("NOW() - INTERVAL '" . self::DUPLICATE_INTERVAL . "'")])
            ->exists();
    }

    private function save(ContactForm $form): void
    {
        $consultingRequest = new ConsultingRequest();
        $consultingRequest->name     = HtmlPurifier::process($form->name);
        $consultingRequest->email    = filter_var($form->email, FILTER_SANITIZE_EMAIL);
        $consultingRequest->phone    = trim(strip_tags($form->phone));
        $consultingRequest->question = HtmlPurifier::process($form->question);
        $consultingRequest->ip       = $form->ip ?? '127.0.0.1';

        if ($consultingRequest->save() === false) {
            throw new Exception('False after save');
        }
    }

    private function buildTelegramMessage(ContactForm $form): string
    {
        $name  = trim((string)$form->name);
        $phone = trim((string)$form->phone);
        $email = trim((string)$form->email);
        $q     = trim((string)$form->question);
        $ip    = (string)($form->ip ?? 'unknown');

        return "Новая запись на консультацию\n"
            . "👤 Имя: {$name}\n"
            . "📞 Тел: {$phone}\n"
            . "✉️ Email: {$email}\n"
            . "❓ Вопрос: {$q}\n"
            . "🌐 IP: {$ip}";
    }

    private function formToJson(ContactForm $form): string
    {
        return (string)json_encode(
            $form->getAttributes(['name', 'email', 'phone', 'question', 'website']),
            JSON_UNESCAPED_UNICODE
        );
    }

    private function createLog(string $message): void
    {
        LogHelper::writeInfo($message, Yii::getAlias('@runtime/logs/consulting.log'));
    }
}
