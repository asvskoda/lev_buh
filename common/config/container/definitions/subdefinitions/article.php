<?php

declare(strict_types=1);

use common\modules\article\repositories\interfaces\ArticleRepositoryInterface;
use common\modules\article\repositories\ArticleDBRepository;
use common\modules\article\services\interfaces\ArticleServiceInterface;
use common\modules\article\services\ArticleService;

return [
    ArticleRepositoryInterface::class => ArticleDBRepository::class,
    ArticleServiceInterface::class => ArticleService::class,
];
