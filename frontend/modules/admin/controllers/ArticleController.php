<?php

declare(strict_types=1);

namespace frontend\modules\admin\controllers;

use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use common\modules\article\services\interfaces\ArticleServiceInterface;
use yii\base\Module;

final class ArticleController extends Controller
{
    private const SUCCESS = 'success';

    private ArticleServiceInterface $seoService;

    public function __construct(
        string $id,
        Module $module,
        ArticleServiceInterface $seoService,
        array $config = []
    ) {
        $this->seoService = $seoService;

        parent::__construct($id, $module, $config);
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function actionIndex(): string
    {
        $article =  $this->seoService->findOrCreate();
        $dataProvider = $this->seoService->getDataProvider();

        return $this->render('index', compact('dataProvider', 'article'));
    }

    public function actionGetEditorTemplate(?int $id = null): string
    {
        $article = $this->seoService->findOrCreate($id);

        return $this->renderAjax('_editor', compact('article'));
    }

    public function actionSave(?int $id = null): string
    {
        $article = $this->seoService->createOrUpdate($this->request, $id);

        if ($article->hasErrors()) {
            return $this->renderAjax('_editor', compact('article'));
        }

        return self::SUCCESS;
    }

    public function actionDelete(int $id): void
    {
        $this->seoService->remove($id);
    }
}
