<?php

namespace frontend\modules\admin\controllers;

use yii\web\Controller;

class DummyController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }
}