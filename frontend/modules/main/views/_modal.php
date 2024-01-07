<?php
use frontend\modules\main\forms\ContactForm;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var ContactForm $model */
?>

<div class='modal fade' id='myModal' tabindex='-1' role='dialog' aria-labelledby='myModalLabel'
     aria-hidden='true'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <div class='modal-body'>
                <?php $form = ActiveForm::begin(['id' => 'contact-form', 'action' => ['create-consulting'], 'options' => []]); ?>
                <?= $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'email') ?>
                <?= $form->field($model, 'phone') ?>
                <?= $form->field($model, 'question')->textInput() ?>
                <div class="form-group consulting-submit-button">
                    <?= Html::submitButton(Yii::t('app', 'Надіслати'),
                        ['class' => 'btn btn-success', 'name' => 'contact-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class='modal-footer'>
                <button type='button' class='btn btn-secondary close-modal' data-dismiss='modal'>
                    <?= Yii::t('app', 'Закрити') ?>
                </button>
            </div>
        </div>
    </div>
</div>
