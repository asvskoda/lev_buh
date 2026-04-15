<?php

namespace frontend\modules\admin\controllers;

use common\modules\notifications\models\ConsultingRequest;
use yii\base\Module;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class AdminController extends Controller
{
    public $layout = 'main-admin';
    public function actionIndex(){

        $dataProvider = new ActiveDataProvider([
            'query' => ConsultingRequest::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
        'dataProvider' => $dataProvider,
    ]);
    }
}