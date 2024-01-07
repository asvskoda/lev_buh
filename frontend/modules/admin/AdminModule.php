<?php

declare(strict_types=1);

namespace frontend\modules\admin;

use yii\base\Module as BaseModule;

final class AdminModule extends BaseModule
{
    public $controllerNamespace = 'frontend\modules\admin\controllers';

    /**
     * @inheritDoc
     */
    public function init()
    {
        parent::init();

        //$this->params['test'] = 'test';
    }
}
