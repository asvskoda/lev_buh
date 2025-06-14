<?php

use common\widgets\Alert;
use frontend\modules\main\assets\AppAsset;
use yii\bootstrap\Html;
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\web\View;

/** @var View $this */
/** @var string $content */

$this->registerLinkTag(['rel' => 'canonical', 'href' => Url::canonical()]);
$this->registerLinkTag(['rel' => 'alternate', 'hreflang' => 'uk', 'href' => Url::to(['', 'lang' => 'uk'], true)]);
$this->registerLinkTag(['rel' => 'alternate', 'hreflang' => 'ru', 'href' => Url::to(['', 'lang' => 'ru'], true)]);
$this->registerLinkTag(['rel' => 'alternate', 'hreflang' => 'x-default', 'href' => Url::canonical()]);
// todo
$this->registerMetaTag(['name' => 'description', 'content' => Yii::t('app', 'Опис сайту українською')]);

$myAssetBundle = AppAsset::register($this);

$currentRoute = Yii::$app->controller->getRoute();
$currentParams = Yii::$app->request->getQueryParams();
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang='<?= Yii::$app->language ?>' class='h-100'>
    <head>
        <meta charset='<?= Yii::$app->charset ?>'>
        <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
        <?php $this->registerCsrfMetaTags() ?>
        <?= "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css'>" ?>
        <title><?= Html::encode(Yii::t('app', $this->title)) ?></title>
        <?php $this->head() ?>
    </head>
    <body>
    <?php $this->beginBody() ?>

    <header class='header'>
        <div class='header-menu lev-font-color'>
            <div class='container'>
                <nav class='header-menu__container'>
                    <div class='header-logo'>
                        <a class='header-logo__link' href='/'>
                            <?= Html::img($myAssetBundle->baseUrl . '/images/icon-round.webp') ?>
                        </a>
                    </div>
                    <div class='header-navbar'>
                        <div class='header-navbar__btn'>
                            <span class='header-navbar__btn-row'></span>
                            <span class='header-navbar__btn-row'></span>
                            <span class='header-navbar__btn-row'></span>
                        </div>
                        <ul class='header-navbar__list'>
                            <li class='nav-item'>
                                <?= Html::a(Yii::t('app', 'Головна'), ['/'], ['class' => 'nav-link main']) ?>
                            </li>
                            <li class='nav-item'>
                                <?= Html::a(Yii::t('app', 'Послуги'), ['/serve'], ['class' => 'nav-link serve']) ?>
                            </li>
                            <li class='nav-item'>
                                <?= Html::a(Yii::t('app', 'Ціни'), ['/price'], ['class' => 'nav-link price']) ?>
                            </li>
                            <li class='nav-item'>
                                <?= Html::a(Yii::t('app', 'Контакти'), ['/contact'], ['class' => 'nav-link contact']) ?>
                            </li>
                            <?php if (!Yii::$app->user->isGuest): ?>
                                <li class='nav-item'>
                                    <?= Html::a(
                                        Yii::t('app', 'Адмінка'),
                                        ['/admin/consulting/index'],
                                        ['class' => 'nav-link consulting']
                                    ) ?>
                                </li>
                                <li class='nav-item'>
                                    <?= Html::beginForm(['/admin/auth/logout'], 'post', ['class' => 'd-flex'])
                                    . Html::submitButton(
                                        'Logout (' . Yii::$app->user->identity->username . ')',
                                        ['class' => 'btn btn-link logout text-decoration-none']
                                    )
                                    . Html::endForm(); ?>
                                </li>
                            <?php endif ?>
                        </ul>
                        <div id='language-switcher'>
                            <?= Html::a(
                                Yii::t('app', 'Українська'),
                                ['/main/home/language', 'lang' => 'uk', 'returnRoute' => $currentRoute, 'returnParams' => $currentParams],
                                ['class' => Yii::$app->language === 'uk' ? 'active' : '']
                            ) ?>
                            <?= Html::a(
                                Yii::t('app', 'Російська'),
                                ['/main/home/language', 'lang' => 'ru', 'returnRoute' => $currentRoute, 'returnParams' => $currentParams],
                                ['class' => Yii::$app->language === 'ru' ? 'active' : '']
                            ) ?>
                        </div>
                        <a class='header-navbar__contacts' href='tel:+380986073304'>
                            <span><?= Yii::t('app', "Ми на зв'язку") ?></span>
                            <span>+38 (098) 607-33-04</span>
                            <small>Пн.-Пт. з 09:00 до 18:00</small>
                        </a>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <main role='main'>
        <?php if (isset($this->params['breadcrumbs'])) : ?>
        <div class='breadcrumbs' id='breadcrumbs'>
            <ul class='breadcrumb'>
                <?= Breadcrumbs::widget([
                    'itemTemplate' => "<li>{link}</li>\n",
                    'links' => $this->params['breadcrumbs'],
                    'homeLink' => [
                        'label' => Yii::t('app', 'Головна'),
                        'url' => ['/'],
                        'template' => "<i class='ace-icon fa fa-home home-icon'></i><li>{link}</li>",
                    ],
                    'options' => ['class' => 'breadcrumb container'],
                ]) ?>
            </ul>
        </div>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
        <div class='up-button__wrapper'>
            <a href="" class="up-button">
                <svg width='29' height='29' viewBox='0 0 50 29' fill='none'>
                    <path class='up-button__path' d='M4.5 24.5L25 4L45.5 24.5' stroke='#545683' stroke-width='4'
                          stroke-linecap='round' stroke-linejoin='round'></path>
                </svg>
            </a>
        </div>
    </main>

    <footer class='footer lev-bg cw'>
        <div class='container'>
            <div class='footer-logo'>
                <a class='cw td' href='/'>
                    <?= Html::img($myAssetBundle->baseUrl . '/images/icon-round.webp') ?>
                    <span class='cw'><?= Yii::t('app', 'Бухгалтерська агенція "ЛЕВ"') ?></span>
                </a>
                <span><?= Yii::t('app', 'Наш супровід - Ваш спокій') ?></span>
            </div>
            <div class='footer-contacts'>
                <h2 class='footer-title'><?= Yii::t('app', 'Контакти') ?></h2>
                <a class='phone cw td' href='tel:+380986073304'>
                    <i class='fa-solid fa-phone-volume'></i>
                    +38 (098) 607-33-04
                </a>
                <a class='mail cw td' href='mailto:lev.buh.agency@gmail.com'>
                    <i class='fa-solid fa-envelope'></i>
                    lev.buh.agency@gmail.com
                </a>
                <div class='social-icons-block'>
                    <a rel='noopener noreferrer' target='_blank' href='https://t.me/lev_buh' class='social-icons-link'>
                        <i class='fa-brands fa-telegram cw'></i>
                    </a>
                    <a rel='noopener noreferrer' target='_blank' href='viber://chat?number=+380986073304'
                       class='social-icons-link'>
                        <i class='fa-brands fa-viber cw'></i>
                    </a>
                    <a rel='noopener noreferrer' target='_blank' href='https://www.instagram.com/lev_buh_agency'
                       class='social-icons-link'>
                        <i class='fa-brands fa-instagram cw'></i>
                    </a>
                    <a rel='noopener noreferrer' target='_blank'
                       href='https://www.facebook.com/profile.php?id=61555635522199' class='social-icons-link'>
                        <i class='fa-brands fa-facebook cw'></i>
                    </a>
                </div>
            </div>
            <div class='footer-address'>
                <h2 class='footer-title'><?= Yii::t('app', 'Адреса офісу') ?></h2>
                <a class='cw td' href='/contact'>
                    <i class='fa-solid fa-location-dot'></i>
                    <?= Yii::t('app', 'Харківська обл., смт Пісочин (с.Надточії), вул.Дачна 39') ?>
                </a>
            </div>
        </div>
    </footer>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
