<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Наша компанія';
$this->registerMetaTag([
        'name' => 'description',
        'content' => 'Команда Lev-Buh — профессиональные бухгалтеры с опытом более 10 лет.' //todo Yii::t(
]);


$this->params['breadcrumbs'][] = 'About';
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>This is the About page.</p>
</div>
