<?php

declare(strict_types=1);

use common\modules\article\models\Article;
use frontend\modules\main\assets\ArticleAsset;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;

ArticleAsset::register($this);

$this->title = Yii::t('app', 'Список статей');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Статьи')];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Список')];

/**
 * @var View $this
 * @var Article $article
 * @var ActiveDataProvider $dataProvider
 */
?>

<div class='site-contact lev-font-color container'>
    <div class="articles">
        <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-bordered table-hover'],
                'rowOptions' => function (Article $article) {
                    return ['id' => $article->id, 'onclick' => 'showEditor(this.id)', 'class' => 'list__row'];
                },
                'columns' => [
                        'header',
                        [
                                'attribute' => 'title',
                                'headerOptions' => ['class' => 'to-hide'],
                                'contentOptions' => ['class' => 'to-hide'],
                                'filterOptions' => ['class' => 'to-hide'],
                        ],
                        [
                                'attribute' => 'description',
                                'headerOptions' => ['class' => 'to-hide'],
                                'contentOptions' => ['class' => 'to-hide'],
                                'filterOptions' => ['class' => 'to-hide'],
                        ],
                        [
                                'attribute' => 'keywords',
                                'headerOptions' => ['class' => 'to-hide'],
                                'contentOptions' => ['class' => 'to-hide'],
                                'filterOptions' => ['class' => 'to-hide'],
                        ],
                        [
                                'attribute' => 'slug',
                                'headerOptions' => ['class' => 'to-hide'],
                                'contentOptions' => ['class' => 'to-hide'],
                                'filterOptions' => ['class' => 'to-hide'],
                        ],
                        [
                                'attribute' => 'image_path',
                                'headerOptions' => ['class' => 'to-hide'],
                                'contentOptions' => ['class' => 'to-hide'],
                                'filterOptions' => ['class' => 'to-hide'],
                        ],
                        [
                                'attribute' => 'image_alt',
                                'headerOptions' => ['class' => 'to-hide'],
                                'contentOptions' => ['class' => 'to-hide'],
                                'filterOptions' => ['class' => 'to-hide'],
                        ],
                        [
                                'attribute' => 'created_at',
                                'format' => ['date', 'php:d.m.Y H:i:s'],
                                'headerOptions' => ['class' => 'to-hide'],
                                'contentOptions' => ['class' => 'to-hide'],
                                'filterOptions' => ['class' => 'to-hide'],
                        ],
                ],
        ]); ?>
    </div>
</div>
