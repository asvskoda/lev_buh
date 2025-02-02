<?php

declare(strict_types=1);

namespace common\modules\notifications\models;

use yii\db\ActiveRecord;
use yii\helpers\HtmlPurifier;
use yii\validators\BooleanValidator;
use yii\validators\EmailValidator;
use yii\validators\FilterValidator;
use yii\validators\IpValidator;
use yii\validators\RequiredValidator;
use yii\validators\SafeValidator;
use yii\validators\StringValidator;
use Yii;
use yii\behaviors\AttributeBehavior;

/**
 * @property positive-int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $question
 * @property string $ip
 */
final class ConsultingRequest extends ActiveRecord
{
    public static function tableName(): string
    {
        return '{{%consulting_requests}}';
    }

    /**
     * @inheritDoc
     */
    public function rules()
    {
        return [
            [
                ['name', 'email', 'question','phone'],
                RequiredValidator::class,
                'message' => Yii::t('app', 'Не може бути пустим')
            ],
            [['name', 'email', 'question','phone'], FilterValidator::class, 'filter' => 'trim'],
            ['question', StringValidator::class],
            ['name', StringValidator::class, 'min' => 3, 'max' => 100],
            [
                'phone',
                StringValidator::class,
                'min' => 10,
                'max' => 13,
                'message' =>  Yii::t('app', 'Невірний формат номера телефону')
            ],
            ['email', EmailValidator::class],
            ['ip', IpValidator::class],
            ['is_active', SafeValidator::class],
            ['is_active', BooleanValidator::class],
        ];
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        if (preg_match('/^[a-zA-Z\s]+$/', $this->question)) {
            return true;
        }

        return parent::save($runValidation, $attributeNames);
    }
}
