<?php

declare(strict_types=1);

namespace app\models;

use Yii;
use yii\validators\DefaultValueValidator;
use yii\validators\NumberValidator;
use yii\validators\RequiredValidator;
use yii\validators\SafeValidator;
use yii\db\ActiveRecord;
use yii\validators\StringValidator;
use yii\validators\UniqueValidator;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property string|null $language User preferred language
 */
final class User extends ActiveRecord
{
    /**
     * @inheritDoc
     */
    public static function tableName(): string
    {
        return '{{%user}}';
    }

    /**
     * @inheritDoc
     */
    public function rules(): array
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', ], RequiredValidator::class],
            [[ 'auth_key', 'password_hash', 'created_at', 'updated_at'], SafeValidator::class],
            [['status', 'verification_token', 'auth_key'], DefaultValueValidator::class, 'value' => null],
            [['status', 'created_at', 'updated_at'], NumberValidator::class],
            [['username', 'password_hash', 'password_reset_token', 'email'], StringValidator::class, 'max' => 255],
            [['auth_key'], StringValidator::class, 'max' => 32],
            [['language'], StringValidator::class, 'max' => 5],
            [['email'], UniqueValidator::class, 'targetClass' => self::class, 'targetAttribute' => 'email'],
            [['username', 'password_reset_token'], UniqueValidator::class],
        ];
    }
}
