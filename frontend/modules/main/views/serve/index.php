<?php

/** @var yii\web\View $this */
/** @var  $myAssetBundle */

use frontend\modules\main\assets\AppAsset;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Послуги');
$this->registerMetaTag([
        'name' => 'description',
        'content' =>
            'Бухгалтерські послуги для ФОП та ТОВ: ведення обліку, подання звітності, розрахунок податків, консультації та супровід бізнесу.'
]);

$this->params['breadcrumbs'][] = 'Serve';

$myAssetBundle = AppAsset::register($this);
?>
<div class="site-about container lev-font-color">
    <div class="serve-bg bg-two_notebooks">
        <div class='serve-row'>
            <div class='serve-text-block'>
                <p class="serve-text__title"><?= Yii::t('app_service', 'Бухгалтерський облік:') ?></p>
                <ul>
                    <li><?= Yii::t('app_service', 'комплексний бухгалтерський супровід') ?></li>
                    <li><?= Yii::t('app_service', 'підготовка всіх фінансових звітів') ?></li>
                    <li><?= Yii::t('app_service', 'аудит фінансової звітності та облікових програм') ?></li>
                </ul>
            </div>
            <div class='serve-round-image'>
                <?= Html::img($myAssetBundle->baseUrl . '/images/serve/two-notebooks-round.webp') ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="serve-bg bg-codecs">
        <div class='serve-row'>
            <div class='serve-round-image'>
                <?= Html::img($myAssetBundle->baseUrl . '/images/serve/codecs-round.webp') ?>
            </div>
            <div class='serve-text-block'>
                <p class="serve-text__title"><?= Yii::t('app_service', 'Податковий супровід:') ?></p>
                <ul>
                    <li><?= Yii::t('app_service', 'складання та подання податкової звітності') ?></li>
                    <li><?= Yii::t('app_service', 'розблокування податкових накладних') ?></li>
                    <li><?= Yii::t('app_service', 'оцінка стану платника податків') ?></li>
                    <li><?= Yii::t('app_service', 'оптимізація податкових зобов`язань') ?></li>
                    <li><?= Yii::t('app_service', 'супровід податкових перевірок') ?></li>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    <div class="serve-bg bg-notebook">
        <div class='serve-row'>
            <div class='serve-text-block'>
                <p class="serve-text__title"><?= Yii::t('app_service', 'Кадровий облік:') ?></p>
                <ul>
                    <li><?= Yii::t('app_service', 'ведення кадрової документації') ?></li>
                    <li><?= Yii::t('app_service', 'облік робочого часу') ?></li>
                    <li><?= Yii::t('app_service', 'розрахунок заробітної плати') ?></li>
                    <li><?= Yii::t('app_service', 'подання звітності') ?></li>
                </ul>
            </div>
            <div class='serve-round-image'>
                <?= Html::img($myAssetBundle->baseUrl . '/images/serve/notebook-round.webp') ?>
            </div>
        </div>
    </div>
    <hr>
    <div class='serve-row'>
        <span class="serve-text__title"><?= Yii::t('app_service', 'Індивідуальне консультування') ?></span>
        <p>
            <?= Yii::t('app_service', 'Наші фахівці готові надати індивідуальні консультації, враховуючи унікальні потреби та особливості вашого бізнесу.') ?>
        </p>
    </div>
</div>