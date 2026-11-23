<?php

use common\modules\notifications\services\antispam\ConsultingFormToken;
use frontend\modules\main\forms\ContactForm;
use yii\helpers\Html;

/**
 * Скрытые поля защиты от спама — подключать в каждую форму, отправляемую на create-consulting
 *
 * @var ContactForm $model
 */
?>
<div class='consulting-hp' aria-hidden='true'>
    <?= Html::activeTextInput($model, 'website', ['value' => '', 'tabindex' => '-1', 'autocomplete' => 'off']) ?>
</div>
<?= Html::activeHiddenInput($model, 'formToken', ['value' => Yii::$container->get(ConsultingFormToken::class)->issue()]) ?>
