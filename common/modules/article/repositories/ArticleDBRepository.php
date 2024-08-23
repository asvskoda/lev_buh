<?php

declare(strict_types=1);

namespace common\modules\article\repositories;

use common\modules\article\exceptions\NotFoundException;
use common\modules\article\models\Article;
use yii\db\ActiveQuery;

final class ArticleDBRepository implements interfaces\ArticleRepositoryInterface
{
    /** @ineritdoc */
    public function getProviderQuery(): ActiveQuery
    {
        return Article::find()->orderBy(['created_at' => SORT_DESC]);
    }

    /** @ineritdoc */
    public function findById(int $id): ?Article
    {
        return Article::find()->where(['id' => $id])->limit(1)->one();
    }

    /** @ineritdoc */
    public function save(Article $article): void
    {
        $article->save();
    }

    /** @ineritdoc */
    public function remove(Article $article): void
    {
        $article->delete();
    }

    /** @ineritdoc */
    public function findBySlug(string $slug): ?Article
    {
        $article = Article::find()->where(['slug' => $slug])->limit(1)->one();

        if ($article === null) {
            throw new NotFoundException('Статья не найдена');
        }

        return $article;
    }

    /** @ineritdoc */
    public function findArticles(int $limit): array
    {
        return $this->getProviderQuery()->limit($limit)->all();
    }
}
