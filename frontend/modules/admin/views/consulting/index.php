<?php

use common\modules\notifications\models\ConsultingRequest;
use frontend\modules\admin\assets\AdminAsset;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Consulting Requests');
$this->params['breadcrumbs'][] = $this->title;
$myAssetBundle = AdminAsset::register($this);
?>
<div class="consulting-request-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Consulting Request'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'email:email',
            'phone',
            'question:ntext',
            'is_active:boolean',
            'created_at',
            [
                'class' => ActionColumn::class,
                'header'=>'Actions',
                'template' => '{update}',
                'urlCreator' => function ($action, ConsultingRequest $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
