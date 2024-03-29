<?php

use yii\bootstrap5\Button;
use frontend\modules\main\forms\ContactForm;

/** @var yii\web\View $this */
/** @var ContactForm $model */

$this->title = Yii::t('app', 'ЛЕВ Бухгалтерська агенція');
?>
<div id="main-fon" class='text-white fon-title'>
    <div class='title-main'>
        <span>
            <?= Yii::t('app', 'Бухгалтерська') ?></br>
            <?= Yii::t('app', 'агенція "ЛЕВ"') ?></br>
        </span>
    </div>
    <div>&nbsp;</div>
    <div>&nbsp;</div>
    <div class='small-font title-children'>
        <?= Yii::t('app', 'Наш супровід - Ваш спокій') ?>
    </div>
    <div class='consultation-appointment'>
        <?= Button::Widget([
            'label' => Yii::t('app', 'Запис на консультацію'),
            'options' => ['class' => 'btn btn-light modal-button-consulting', 'data-toggle' => 'modal', 'data-target' => '#myModal', 'type' => 'button'],
        ]); ?>
    </div>

</div>
<div class='container'>
    <div class='body-content'>
        <?= $this->render('../_modal', ['model' => $model]) ?>
        <div class='row'>
            <div class='text-center main-us-select-title'>
                <h1><?= Yii::t('app', 'Про нас:'); ?></h1>
            </div>
            <div class='about-us-block'>
                <p class='tf'>
                    &nbsp;&nbsp;Ми – бухгалтерська агенція, що досить недовго працює на ринку України🇺🇦. Але сьогодні можемо з
                    впевненістю сказати, що за нашими плечима вже багато задоволених клієнтів.👥
                    Це все тому, що провідні бухгалтери нашої агенції мають досвід роботи в фінансовій сфері понад 15
                    років🤓, а помічниці – доповнюють їх наполегливістю в праці та навчанні.🎓
                    Нам довіряють вести свою бухгалтерію промислові підприємства та підприємства торгівлі (юридичні
                    особи на загальній системі оподаткування з ПДВ), представники громадського харчування та
                    ІТ-спеціалісти (ФОПи на єдиному податку), надавачі послуг населенню та неприбуткові організації.📝
                    Ми беремо на себе всю рутинну роботу з бухгалтерського обліку, складаємо податкову звітність та
                    допомагаємо в усіх напрямках управлінського обліку.🍀
                </p>
            </div>
        </div>
        <div class='row'>
            <div class='text-center main-us-select-title'>
                <h1><?= Yii::t('app', 'Нас обирають:') ?></h1>
            </div>
            <div class='col-lg-3 main-us-select-item'>
                <h2 class='tc'><?= Yii::t('app', 'Mалий та середній бізнес (ТОВ, ФОП)'); ?></h2>
                <p class='tc'>
                    Юридичні особи, які прагнуть оптимізувати свою діяльність та зосередитися на основних завданнях,
                    шукають ефективне та професійне ведення обліку та кадрового управління за доступними витратами.
                </p>
            </div>
            <div class='col-lg-3 main-us-select-item'>
                <h2 class='tc'><?= Yii::t('app', 'Фрілансери та самозайняті особи'); ?></h2>
                <p class='tc'>
                    Фізичні особи - підприємці, які ведуть власний бізнес,
                    і прагнуть ефективних рішень для свого обліку та оподаткування.
                </p>
            </div>
            <div class='col-lg-3 main-us-select-item'>
                <h2 class='tc'><?= Yii::t('app', 'Стартапи та нові підприємства'); ?></h2>
                <p class='tc'>
                    Нові компанії, які потребують експертної допомоги в бухгалтерському та управлінському обліку,
                    але не можуть собі дозволити великий внутрішній штат спеціалістів.
                </p>
            </div>
            <div class='col-lg-3 main-us-select-item'>
                <h2 class='tc'><?= Yii::t('app', 'Сектор не комерційних організацій'); ?></h2>
                <p class='tc'>
                    Неприбуткові організації, які не мають прибуткової мети,
                    і шукають послуги з обліку та фінансового управління
                </p>
            </div>
        </div>
        <div class='row'>
            <div class='text-center main-about-us'>
                <h1>Бухгалтерська агенція "ЛЕВ" - це:</h1>
            </div>
            <div class='col-lg-4 main-about-us-item'>
                <h2 class='tc'>Глибокий досвід та професіоналізм</h2>
                <p class='tc'>
                    Провідні бухгалтери агенції мають досвід роботи понад 16 років та гарантують високу експертизу
                    й точність у веденні обліку для різних галузей.
                </p>
            </div>
            <div class='col-lg-4 main-about-us-item'>
                <h2 class='tc'>Широкий спектр послуг</h2>
                <p>
                    Комплексне обслуговування з бухгалтерського, податкового,
                    управлінського та кадрового обліку для різних видів підприємств.
                </p>
            </div>
            <div class='col-lg-4 main-about-us-item'>
                <h2 class='tc'>Онлайн обслуговування</h2>
                <p class='tc'>
                    Надання послуг як в офісі, так і онлайн,
                    що забезпечує максимальну зручність та доступність для клієнтів.
                </p>
            </div>
            <div class='col-lg-4 main-about-us-item'>
                <h2 class='tc'>Індивідуальний підхід</h2>
                <p class='tc'>
                    Орієнтація на потреби клієнтів різних галузей, забезпечуючи персоналізовані рішення та консультації.
                </p>
            </div>
            <div class='col-lg-4 main-about-us-item'>
                <h2 class='tc'>Висока ефективність та швидкість</h2>
                <p class='tc'>
                    Використання передових технологій для автоматизації процесів та оперативного вирішення завдань.
                </p>
            </div>
            <div class='col-lg-4 main-about-us-item'>
                <h2 class='tc'>Різноманітні галузі обслуговування</h2>
                <p class='tc'>
                    Досвід роботи з підприємствами торгівлі, виробництва, надання послуг, громадського харчування,
                    IT сфери та неприбуткових організацій.
                </p>
            </div>
            <div class='col-lg-4 offset-lg-2 main-about-us-item-last'>
                <h2 class='tc'>Безпека даних</h2>
                <p class='tc'>
                    Гарантована безпека та конфіденційність даних клієнтів,
                    що особливо важливо для обробки чутливої фінансової інформації.
                </p>
            </div>
            <div class='col-lg-4 main-about-us-item-last'>
                <h2 class='tc'>Конкурентноспроможні тарифи</h2>
                <p class='tc'>
                    Агенція може запропонувати конкурентоспроможні тарифи та гнучку систему оплати для своїх клієнтів.
                </p>
            </div>
        </div>
    </div>
</div>
