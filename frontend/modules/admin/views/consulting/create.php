<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\modules\notifications\models\ConsultingRequest $model */

$this->title = Yii::t('app', 'Create Consulting Request');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Consulting Requests'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="consulting-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
