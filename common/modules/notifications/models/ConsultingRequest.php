<?php

declare(strict_types=1);

namespace common\modules\notifications\models;

use yii\db\ActiveRecord;
use yii\validators\RequiredValidator;
use yii\validators\StringValidator;

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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','email', 'phone', 'question'], RequiredValidator::class],
            [['name', 'question', 'phone', 'email'], StringValidator::class],
            ['is_active', 'boolean'],
        ];
    }

    public function beforeSave($insert)
    {
        return parent::beforeSave($insert);
    }
}
