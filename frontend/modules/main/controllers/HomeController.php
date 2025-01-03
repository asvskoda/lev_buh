<?php

declare(strict_types=1);

namespace frontend\modules\main\controllers;

use common\modules\notifications\services\ConsultingService;
use frontend\modules\main\forms\ContactForm;
use yii\web\Controller;
use yii\helpers\Url;
use yii\web\Request;
use yii\web\Response;
use Yii;
use common\helpers\LogHelper;

final class HomeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', ['model' => new ContactForm()]);
    }

    public function actionCreateConsulting(Request $request): Response
    {
        $form = new ContactForm();
        $ipAddress = Yii::$app->request->userIP;
        $post = $request->post();
        $formInfo = $post['ContactForm'];
        $formInfo['ip'] = $ipAddress;
        $form->ip = $ipAddress;

        if (!$request->isPost && !$form->load($post) && !$form->validate()) {
            return $this->redirect(Url::toRoute('index'));
        }

        $jsonFormInfo = json_encode($formInfo);

        try {
            $form->load($post);
            if ($form->validate()) {
                $consultingService = new ConsultingService();
                $consultingService->notification($form);
            } else {
                LogHelper::writeInfo(
                    'Ошибка валидации - ' . $jsonFormInfo,
                    Yii::getAlias('@runtime/logs/consulting.log')
                );
            }

            Yii::$app->session->setFlash(
                'success',
                Yii::t('app', 'Ваш запит прийнято. Ми зателефонуємо вам ')
            );
        } catch (\Throwable $exception) {
            LogHelper::writeInfo(
                $jsonFormInfo . ' error - ' . $exception->getMessage(),
                Yii::getAlias('@runtime/logs/consulting.log')
            );

            Yii::$app->session->setFlash(
                'error',
                Yii::t('app', 'Технічна помилка, спробуйте через деякий час')
            );
        }

        return $this->redirect(Url::toRoute('index'));
    }
}
