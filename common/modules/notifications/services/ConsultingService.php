<?php

declare(strict_types=1);

namespace common\modules\notifications\services;

use common\modules\notifications\models\ConsultingRequest;
use frontend\modules\main\forms\ContactForm;
use Yii;
use yii\db\Exception;
use yii\helpers\HtmlPurifier;
use common\helpers\LogHelper;
use yii\web\Session;
use common\modules\notifications\services\notifiers\NotifierInterface;

final class ConsultingService
{
    private const IP_SPAM_KEY = 'consulting_ip_spam_key';

    private Session $session;
    private NotifierInterface $notifier;

    public function __construct(NotifierInterface $notifier)
    {
        $this->session  = Yii::$container->get(Session::class);
        $this->notifier = $notifier;
    }

    /**
     * @throws \Exception
     */
    public function notification(ContactForm $form): void
    {
        $this->createLog('CONSULT notification called. URI=' . Yii::$app->request->url . ' METHOD=' . Yii::$app->request->method);

        $ipSpamKey = self::IP_SPAM_KEY . $form->ip;

        if ($this->session->has($ipSpamKey)) {
            $this->createLog("Blacklist ip - {$form->ip} ");
            return;
        }

        if (preg_match('/^[a-zA-Z\s]+$/', (string)$form->question)) {
            $this->session->set($ipSpamKey, time() . ' - ' . $form->ip);
            $this->createLog("Question is wrong, ip - {$form->ip}, " . $form->question);
            return;
        }

        $dedupKey = 'consult_dedup_' . sha1(
                trim((string)$form->phone) . '|' .
                trim((string)$form->email) . '|' .
                trim((string)$form->question) . '|' .
                (string)($form->ip ?? '')
            );

        if ($this->session->has($dedupKey)) {
            $this->createLog("Dedup hit, skip. key={$dedupKey}");
            return;
        }

        $this->session->set($dedupKey, time());

        try {
            $this->save($form);

            $this->notifier->notify($this->buildTelegramMessage($form));

        } catch (\Throwable $exception) {
            $this->createLog('Error save/notify ' . $exception->getMessage());
            throw new \Exception(Yii::t('app', 'Вибачте виникла помилка'));
        }
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

    private function createLog(string $message): void
    {
        LogHelper::writeInfo($message, Yii::getAlias('@runtime/logs/consulting.log'));
    }
}
