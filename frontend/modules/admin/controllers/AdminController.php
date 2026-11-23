<?php

namespace frontend\modules\admin\controllers;

use common\modules\notifications\models\ConsultingRequest;
use yii\base\Module;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;

class AdminController extends Controller
{
    public $layout = 'main-admin';

    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                // страница показывает все заявки с персональными данными — только для авторизованных
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ],
        );
    }

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

        return $this->render(
            'index',
            ['dataProvider' => $dataProvider]
        );
    }
}