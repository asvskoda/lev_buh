<?php

declare(strict_types=1);

namespace frontend\modules\main\controllers;

use common\modules\article\services\interfaces\ArticleServiceInterface;
use yii\base\Module;
use yii\web\Controller;
use Yii;

final class ArticleController extends Controller
{

    private ArticleServiceInterface $articleService;

    /** @inheritDoc */
    public function __construct(
        string $id,
        Module $module,
        ArticleServiceInterface $articleService,
        array $config = []
    ) {
        $this->articleService = $articleService;

        parent::__construct($id, $module, $config);
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $article = $this->articleService->findOrCreate();
        $dataProvider = $this->articleService->getDataProvider();

        return $this->render('index', compact('dataProvider', 'article'));
    }
}
