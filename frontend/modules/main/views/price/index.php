<?php

use frontend\modules\main\assets\AppAsset;
use yii\helpers\Html;

/** @var yii\web\View $this */

$myAssetBundle = AppAsset::register($this);

$this->title = $this->title = Yii::t('app', 'Ціни');
$this->params['breadcrumbs'][] = 'Price';
?>
<div class='site-price container'>
    <div class='row'>
        <div class='col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/10.png') ?>
        </div>
        <div class='col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/11.png') ?>
        </div>
        <div class='col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/12.png') ?>
        </div>
        <div class='col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/16.png') ?>
        </div>
    </div>
    <hr>
    <div class='row'>
        <div class='offset-lg-2 col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/1.png') ?>
        </div>
        <div class='col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/2.png') ?>
        </div>
        <div class='col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/3.png') ?>
        </div>
    </div>
    <div class='row mt-10'>
        <div class='offset-lg-4 col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/4.png') ?>
        </div>
        <div class='col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/5.png') ?>
        </div>
    </div>
    <hr>
    <div class='row'>
        <div class='col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/6.png') ?>
        </div>
        <div class='col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/7.png') ?>
        </div>
        <div class='col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/8.png') ?>
        </div>
        <div class='col-lg-3 main-price-item'>
            <?= Html::img($myAssetBundle->baseUrl . '/images/price/9.png') ?>
        </div>
    </div>
</div>
