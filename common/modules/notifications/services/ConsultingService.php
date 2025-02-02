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

final class ConsultingService
{
    private const IP_SPAM_KEY = 'consulting_ip_spam_key';

    private Session $session;

    public function __construct()
    {
        $this->session = Yii::$container->get(Session::class);
    }


    /**
     * @throws \Exception
     */
    public function notification(ContactForm $form): void
    {

        $ipSpamKey = self::IP_SPAM_KEY . $form->ip;

        $this->deleteIpFromSpamSession($ipSpamKey);

        $sesInfo = $this->session->get($ipSpamKey);

        if ($this->session->has($ipSpamKey)) {
            $this->createLog("Blacklist ip - {$form->ip} ");

            return;
        }

        if (preg_match('/^[a-zA-Z\s]+$/', $form->question)) {
            $this->session->set($ipSpamKey, time() . ' - ' . $form->ip);

            $this->createLog("Question is wrong, ip - {$form->ip}, " . $form->question);

            return;
        }

        try{
            $this->save($form);
            //$this->sendEmail($form);
        } catch (\Throwable $exception) {
            $this->createLog('Error save ' . $exception->getMessage());

            throw new \Exception(Yii::t('Вибачте виникла помилка'));
        }
    }

    /**
     * @param ContactForm $form
     * @throws Exception
     */
    private function save(ContactForm $form): void
    {
        $consultingRequest = new ConsultingRequest();
        $consultingRequest->name = HtmlPurifier::process($form->name);
        $consultingRequest->email = filter_var($form->email, FILTER_SANITIZE_EMAIL);
        $consultingRequest->phone = trim(strip_tags($form->phone));
        $consultingRequest->question = HtmlPurifier::process($form->question);
        $consultingRequest->ip = $form->ip ?? '127.0.0.1';

        if ($consultingRequest->save() === false) {
            throw new Exception('False after save');
        }
    }

    private function createLog(string $message): void
    {
        LogHelper::writeInfo($message, Yii::getAlias('@runtime/logs/consulting.log'));
    }

    private function deleteIpFromSpamSession(string $sessionKey): void
    {
        $this->session->remove($sessionKey);
    }
}
