<?php

declare(strict_types=1);

namespace common\modules\notifications\models;

use yii\db\ActiveRecord;

/**
 * @property positive-int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $question
 */
final class ConsultingRequest extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%consulting_requests}}';
    }

    public function beforeSave($insert)
    {
        return parent::beforeSave($insert);
    }
}
