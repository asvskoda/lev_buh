<?php

use frontend\modules\main\assets\AppAsset;
use yii\helpers\Html;

/** @var yii\web\View $this */

$myAssetBundle = AppAsset::register($this);

$this->title = Yii::t('app_price', 'Ціни');
$this->registerMetaTag([
    'name' => 'description',
    'content' => Yii::t('app_price','Вартість бухгалтерських послуг. Фіксовані тарифи для ФОП та ТОВ.'),
]);

$this->params['breadcrumbs'][] = 'Price';
?>
<div class='container'>
    <section class='padd'>
        <a class="price-card bg-calc" href='#group_1-2'>
            <?= Yii::t('app_price', 'Для ФО-П на єдиному податку 1-2 група') ?>
            <span>1</span>
        </a>
        <a class="price-card bg-calc" href='#group_3'>
            <?= Yii::t('app_price', 'Для ФО-П на єдиному податку 3 група') ?>
            <span>2</span>
        </a>
        <a class="price-card bg-calc" href='#without_tax'>
            <?= Yii::t('app_price', 'Для юридичних осіб на єдиному податку без ПДВ') ?>
            <span>3</span>
        </a>
        <a class="price-card bg-calc" href='#with_tax'>
            <?= Yii::t('app_price', 'Для юридичних осіб на загальній системі оподпткування з ПДВ') ?>
            <span>4</span>
        </a>
        <a class="price-card bg-calc" href='#other_services'>
            <?= Yii::t('app_price', 'Інші послуги') ?>
            <span>5</span>
        </a>

    </section>
    <section class='price-section'>
        <section class='price-category bg-hand' id='group_1-2'>
            <span>1</span>
            <h2 class='price-category__name'><?= Yii::t('app_price', 'Для ФО-П на єдиному податку 1-2 група') ?></h2>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет мінімальний') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i> <?= Yii::t('app_price', 'щомісячний контроль сплати податків') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'заповнення книги обліку доходів') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'подача щорічної звітності') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'консультування') ?></li>
                </ul>
                <p class='cost'>700 грн</p>
            </article>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет стандарт') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'щомісячний контроль сплати податків') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'заповнення книги обліку доходів') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'подача щорічної звітності') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'підготовка та щоквартальна здача 4ДФ') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'консультування') ?></li>
                </ul>
                <p class='cost'>1200-1500 грн</p>
            </article>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет максимальний_1') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'щомісячний контроль сплати податків') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'заповнення книги обліку доходів') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'подача щорічної звітності') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'підготовка та щоквартальна здача 4ДФ') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', '1 найманий працівник (первинні документи, податки та звітність)') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'консультування') ?></li>
                </ul>
                <p class='cost'>2300-2500 грн</p>
            </article>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет максимальний_2') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'щомісячний контроль сплати податків') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'заповнення книги обліку доходів') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'подача щорічної звітності') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'підготовка та щоквартальна здача 4ДФ') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', '2-4 найманий працівник (первинні документи, податки та звітність)') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'консультування') ?></li>
                </ul>
                <p class='cost'>2500-3000 грн</p>
            </article>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет максимальний_3') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'щомісячний контроль сплати податків') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'заповнення книги обліку доходів') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'подача щорічної звітності') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'підготовка та щоквартальна здача 4ДФ') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', '5-8 найманий працівник (первинні документи, податки та звітність)') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'консультування') ?></li>
                </ul>
                <p class='cost'>3100-3900 грн</p>
            </article>
            <h3><?= Yii::t('app_price','Ціну вказано за місяць') ?>* </h3>
        </section>

        <section class='price-category bg-hand' id='group_3'>
            <span>2</span>
            <h2 class='price-category__name'><?= Yii::t('app_price', 'Для ФО-П на єдиному податку 3 група') ?></h2>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет стандарт') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'щомісячний контроль сплати податків') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'заповнення книги обліку доходів') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'підготовка та щоквартальна подача звітності') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'консультування') ?></li>
                </ul>
                <p class='cost'>1500-1900 грн</p>
            </article>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет максимальний_1') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'щомісячний контроль сплати податків') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'заповнення книги обліку доходів') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'подача щоквартальної звітності') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'підготовка та щоквартальна здача 4ДФ') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', '1 найманий працівник (первинні документи, податки та звітність)') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'консультування') ?></li>
                </ul>
                <p class='cost'>2300-2800 грн</p>
            </article>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет максимальний_2') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'щомісячний контроль сплати податків') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'заповнення книги обліку доходів') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'підготовка та щоквартальна подача звітності') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', '2-4 найманий працівник (первинні документи, податки та звітність)') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'консультування') ?></li>
                </ul>
                <p class='cost'>2800-3200 грн</p>
            </article>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет максимальний_3') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'щомісячний контроль сплати податків') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'заповнення книги обліку доходів') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'підготовка та щоквартальна здача звітності') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'від 5 найманий працівник (первинні документи, податки та звітність)') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'консультування') ?></li>
                </ul>
                <p class='cost'>3200-3500 грн</p>
            </article>
            <h3><?= Yii::t('app_price','Ціну вказано за місяць') ?>* </h3>
        </section>

        <section class='price-category bg-hand' id='without_tax'>
            <span>3</span>
            <h2 class='price-category__name'><?= Yii::t('app_price', 'Для юридичних осіб на єдиному податку без ПДВ') ?></h2>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет мінімальний') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'до 20 операцій на місяць') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'до 2 співробітників') ?></li>
                </ul>
                <p class='cost'><?= Yii::t('app_price', 'від') ?> 3500 грн</p>
            </article>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет максимальний') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'більше 20 операцій на місяць') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'більше 2 співробітників') ?></li>
                    <i><?= Yii::t('app_price', 'Можливе додаткове подання звітності:') ?></i>
                    <li>• <?= Yii::t('app_price', 'по військовому обліку') ?></li>
                    <li>• <?= Yii::t('app_price', 'по податку (оренді) на землю та нерухомість') ?></li>
                    <li>• <?= Yii::t('app_price', 'по рентній платі') ?></li>
                    <li>• <?= Yii::t('app_price', 'по екологічному податку') ?></li>
                    <li>• <?= Yii::t('app_price', 'в статистику') ?></li>
                </ul>
                <p class='cost'><?= Yii::t('app_price', 'ціна розраховується індивідуально') ?></p>
            </article>
        </section>
        <section class='price-category bg-hand' id='with_tax'>
            <span>4</span>
            <h2 class='price-category__name'><?= Yii::t('app_price', 'Для юридичних осіб на загальній системі оподаткування з ПДВ') ?></h2>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет мінімальний') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'до 10 операцій на місяць') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'до 2 співробітників') ?></li>
                </ul>
                <p class='cost'><?= Yii::t('app_price', 'від') ?> 5000 грн</p>
            </article>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет стандарт') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'до 30 операцій на міцсяць') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'до 5 співробітників') ?></li>
                </ul>
                <p class='cost'><?= Yii::t('app_price', 'від') ?>  10000 грн</p>
            </article>
            <article class='price-item'>
                <h3 class='price-item__name'><?= Yii::t('app_price', 'Пакет максимальний') ?></h3>
                <ul class='price-item__check'>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'більше 30 операцій на міцсяць') ?></li>
                    <li><i class='fa-solid fa-check'></i><?= Yii::t('app_price', 'більше 5 співробітників') ?></li>
                    <i><?= Yii::t('app_price', 'Можливе додаткове подання звітності:') ?></i>
                    <li>• <?= Yii::t('app_price', 'по військовому обліку') ?></li>
                    <li>• <?= Yii::t('app_price', 'по податку (оренді) на землю та нерухомість') ?></li>
                    <li>• <?= Yii::t('app_price', 'по рентній платі') ?></li>
                    <li>• <?= Yii::t('app_price', 'по екологічному податку') ?></li>
                    <li>• <?= Yii::t('app_price', 'в статистику') ?></li>
                </ul>
                <p class='cost'><?= Yii::t('app_price', 'ціна розраховується індивідуально') ?></p>
            </article>
        </section>
        <section class='price-category bg-hand' id='other_services'>
            <span>5</span>
            <h2 class='price-category__name'><?= Yii::t('app_price', 'Інші послуги') ?></h2>
            <div class='others'>
                <article class='price-item'>
                    <h3 class='price-item__name'><?= Yii::t('app_price', 'Відкриття ФОП') ?></h3>
                    <p class='cost'>2500грн</p>
                </article>
                <article class='price-item'>
                    <h3 class='price-item__name'><?= Yii::t('app_price', 'Закриття ФОП') ?></h3>
                    <p class='cost'>2300грн</p>
                </article>
                <article class='price-item'>
                    <h3 class='price-item__name'><?= Yii::t('app_price', 'Підключення ПРРО') ?></h3>
                    <p class='cost'>2400 грн</p>
                </article>
                <article class='price-item'>
                    <h3 class='price-item__name'><?= Yii::t('app_price', 'Здача річної звітності ФОП на єдиному податку 1 група') ?></h3>
                    <p class='cost'>1700 грн</p>
                </article>
                <article class='price-item'>
                    <h3 class='price-item__name'><?= Yii::t('app_price', 'Здача річної звітності ФОП на єдиному податку 2 група') ?></h3>
                    <p class='cost'>2000 грн</p>
                </article>
                <article class='price-item'>
                    <h3 class='price-item__name'><?= Yii::t('app_price', 'Здача квартальної звітності ФОП 3 група') ?></h3>
                    <p class='cost'>1500 грн</p>
                </article>
                <article class='price-item'>
                    <h3 class='price-item__name'><?= Yii::t('app_price', 'Кадровий облік') ?></h3>
                    <p class='cost'><?= Yii::t('app_price', '800 грн за 1 працівник + 400 грн за кожного наступного') ?></p>
                </article>
            </div>
        </section>
    </section>
</div>