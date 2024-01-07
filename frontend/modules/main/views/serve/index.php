<?php

/** @var yii\web\View $this */
/** @var  $myAssetBundle */

use frontend\modules\main\assets\AppAsset;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Послуги');
$this->params['breadcrumbs'][] = 'Serve';

$myAssetBundle = AppAsset::register($this);
?>
<div class="site-about container">
    <div class='row'>
        <div class='col-lg-6 serve-text-block'>
            <h1>Бухгалтерський облік:</h1>
            <ul>
                <li>комплексний бухгалтерський супровід</li>
                <li>підготовка всіх фінансових звітів</li>
                <li>аудит фінансової звітності та облікових програм</li>
            </ul>
        </div>
        <div class='col-lg-6 serve-round-image'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/serve/two-notebooks-round.png') ?>
        </div>
    </div>
    <hr>
    <div class='row'>
        <div class='col-lg-6 serve-round-image'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/serve/codecs-round.png') ?>
        </div>
        <div class='col-lg-6 serve-text-block'>
            <h1>Податковий супровід:</h1>
            <ul>
                <li>складання та подання податкової звітності</li>
                <li>розблокування податкових накладних</li>
                <li>оцінка стану платника податків</li>
                <li>оптимізація податкових зобов`язань</li>
                <li>супровід податкових перевірок</li>
            </ul>
        </div>
    </div>
    <hr>
    <div class='row'>
        <div class='col-lg-6 serve-text-block'>
            <h1>Кадровий облік:</h1>
            <ul>
                <li>ведення кадрової документації</li>
                <li>облік робочого часу</li>
                <li>розрахунок заробітної плати</li>
                <li>подання звітності</li>
            </ul>
        </div>
        <div class='col-lg-6 serve-round-image'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/serve/notebook-round.png') ?>
        </div>
    </div>
    <hr>
    <div class='row'>
        <div class='col-lg-6'>
            <h1>Індивідуальні консультування:</h1>
            <p>
                Наші фахівці готові надати індивідуальні консультації,
                враховуючи унікальні потреби та особливості вашого бізнесу.
            </p>
        </div>
    </div>
</div>
