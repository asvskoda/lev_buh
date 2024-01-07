<?php

declare(strict_types=1);

namespace frontend\modules\main\controllers;

use frontend\modules\main\forms\ContactForm;use yii\web\Controller;

final class ContactController extends Controller
{
    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', ['model' => new ContactForm()]);
    }
}
