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
    /** Точный повтор заявки (тот же телефон, email и вопрос) за этот период не сохраняется */
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

        // обычная заявка оставляет в логе только итог (данные есть в БД), отказ — причину и данные формы для разбора спама
        if (!$this->rateLimiter->attempt($ip)) {
            $this->createLog("Rate limit exceeded, ip - {$ip}, " . $this->formToJson($form));
            throw new ConsultingRequestRejectedException(
                Yii::t('app', 'Ви щойно надіслали запит. Спробуйте ще раз трохи згодом')
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
            $this->rateLimiter->markAsSpammer($ip);
            $this->createLog("Spam rejected: {$spamReason}, ip - {$ip}, " . $this->formToJson($form));
            return;
        }

        if ($this->isDuplicate($form)) {
            $this->createLog("Duplicate request skipped, ip - {$ip}");
            return;
        }

        try {
            $requestId = $this->save($form);
        } catch (\Throwable $exception) {
            $this->createLog("Save failed, ip - {$ip}: " . $exception->getMessage() . ', ' . $this->formToJson($form));
            throw new \Exception(Yii::t('app', 'Вибачте виникла помилка'));
        }

        $this->createLog("Request saved, id - {$requestId}, ip - {$ip}");

        // заявка уже сохранена: сбой уведомления не должен выглядеть для пользователя как ошибка
        try {
            $delivered = $this->notifier->notify($this->buildTelegramMessage($form));
            $this->createLog(
                $delivered
                    ? "Telegram notification sent, id - {$requestId}"
                    : "Telegram notification not delivered, id - {$requestId}, details in telegram.log"
            );
        } catch (\Throwable $exception) {
            $this->createLog("Telegram notification failed, id - {$requestId}: " . $exception->getMessage());
        }
    }

    private function isDuplicate(ContactForm $form): bool
    {
        return ConsultingRequest::find()
            ->where([
                'phone'    => trim(strip_tags((string)$form->phone)),
                'email'    => filter_var((string)$form->email, FILTER_SANITIZE_EMAIL),
                'question' => HtmlPurifier::process((string)$form->question),
            ])
            ->andWhere(['>=', 'created_at', new Expression("NOW() - INTERVAL '" . self::DUPLICATE_INTERVAL . "'")])
            ->exists();
    }

    /**
     * @return int id сохранённой заявки
     */
    private function save(ContactForm $form): int
    {
        $consultingRequest = new ConsultingRequest();
        $consultingRequest->name     = HtmlPurifier::process($form->name);
        $consultingRequest->email    = filter_var($form->email, FILTER_SANITIZE_EMAIL);
        $consultingRequest->phone    = trim(strip_tags($form->phone));
        $consultingRequest->question = HtmlPurifier::process($form->question);
        $consultingRequest->ip       = $form->ip ?? '127.0.0.1';

        if ($consultingRequest->save() === false) {
            throw new Exception('Validation failed: ' . json_encode($consultingRequest->getFirstErrors(), JSON_UNESCAPED_UNICODE));
        }

        return (int)$consultingRequest->id;
    }

    private function buildTelegramMessage(ContactForm $form): string
    {
        $name     = trim((string)$form->name);
        $phone    = trim((string)$form->phone);
        $email    = trim((string)$form->email);
        $question = trim((string)$form->question);
        $ip       = (string)($form->ip ?? 'unknown');

        return "Новая запись на консультацию\n"
            . "👤 Имя: {$name}\n"
            . "📞 Тел: {$phone}\n"
            . "✉️ Email: {$email}\n"
            . "❓ Вопрос: {$question}\n"
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
