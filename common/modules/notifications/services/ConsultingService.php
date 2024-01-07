<?php

declare(strict_types=1);

namespace common\modules\notifications\services;

use common\modules\notifications\models\ConsultingRequest;
use frontend\modules\main\forms\ContactForm;
use Yii;

final class ConsultingService
{
    public function notification(ContactForm $form)
    {
        try{
            $this->save($form);
            //$this->sendEmail($form);
        } catch (\Throwable $exception) {
            Yii::error($exception->getMessage());

            throw new \Exception('Ошибка в сервисе запроса консультации');
        }
    }

    private function save(ContactForm $form): void
    {
        $consultingRequest = new ConsultingRequest();
        $consultingRequest->name = $form->name;
        $consultingRequest->email = $form->email;
        $consultingRequest->phone = $form->phone;
        $consultingRequest->question = $form->question;
        $consultingRequest->save();
    }
}
