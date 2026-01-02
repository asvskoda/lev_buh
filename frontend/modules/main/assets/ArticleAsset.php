<?php

namespace frontend\modules\main\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

final class ArticleAsset extends AssetBundle
{
    public $sourcePath = '@app/modules/main/web/article';

    public $css = [
        'index.css',
    ];

    public $js = [
        'index.js',
    ];

    public $depends = [
        JqueryAsset::class,
    ];

    public $publishOptions = [
        'forceCopy' => YII_DEBUG,
    ];
}
