<?php

declare(strict_types=1);

namespace common\modules\notifications\services;

use common\modules\notifications\models\ConsultingRequest;
use frontend\modules\main\forms\ContactForm;
use Yii;
use yii\db\Exception;
use yii\helpers\HtmlPurifier;
use common\helpers\LogHelper;

final class ConsultingService
{
    private const IP_BLACK_LIST = [];

    public function notification(ContactForm $form)
    {
        if (in_array($form->ip, self::IP_BLACK_LIST)) {
            LogHelper::writeInfo(
                "Запрос от клиента с ip - {$form->ip} был проигнорирован " . json_encode($form),
                Yii::getAlias('@runtime/logs/consulting.log')
            );
        }

        try{
            $this->save($form);
            //$this->sendEmail($form);
        } catch (\Throwable $exception) {
            LogHelper::writeInfo(
                $exception->getMessage(),
                Yii::getAlias('@runtime/logs/consulting.log')
            );

            throw new \Exception('Ошибка в сервисе запроса консультации');
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
}
