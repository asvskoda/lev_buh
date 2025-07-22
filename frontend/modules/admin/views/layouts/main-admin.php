<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\modules\admin\assets\AdminAsset;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

$myAssetBundle = AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <div class="container-fluid">
            <div class="row">
                <div class="bg-dark text-white p-3" style="width: 250px;">
                    <?= Nav::widget([
                        'options' => ['class' => 'nav flex-column'],
                        'items' => [
                            ['label' => 'Home', 'url' => Yii::$app->homeUrl],
                            ['label' => 'Consulting', 'url' => ['/consulting']],
                            ['label' => 'Article', 'url' => ['/article']],
                            Yii::$app->user->isGuest ?
                                ['label' => 'Login', 'url' => ['/site/login']] :
                                ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                    'url' => ['/admin/auth/logout'],
                                    'linkOptions' => ['data-method' => 'post']]
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-start">&copy; Lev_buh.com <?= date('Y') ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
