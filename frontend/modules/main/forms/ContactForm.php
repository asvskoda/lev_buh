<?php

namespace frontend\modules\main\forms;

use Yii;
use yii\base\Model;
use yii\validators\EmailValidator;
use yii\validators\FilterValidator;
use yii\validators\IpValidator;
use yii\validators\RegularExpressionValidator;
use yii\validators\RequiredValidator;
use yii\validators\SafeValidator;
use yii\validators\StringValidator;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    /** Любой номер: 10–15 цифр, допускаются +, пробелы, скобки и дефисы */
    private const PHONE_PATTERN = '/^\+?(?:[\s\-()]*\d){10,15}[\s\-()]*$/';
    /**
     * Украинский номер: 0XXXXXXXXX, 380XXXXXXXXX или +380XXXXXXXXX.
     * Не украинские номера отсекает антиспам молча, чтобы спамер не узнал о правиле
     */
    private const UA_PHONE_PATTERN = '/^(?:\+?38)?[\s\-()]*0(?:[\s\-()]*\d){9}$/';

    public $name;
    public $email;
    public $question;
    public $phone;
    public $ip;
    /** Ловушка для ботов: скрытое поле, человек его не заполняет */
    public $website;
    /** Подписанная метка времени показа формы */
    public $formToken;

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
                RegularExpressionValidator::class,
                'pattern' => self::PHONE_PATTERN,
                'message' => Yii::t('app', 'Невірний формат номера телефону')
            ],
            // украинский номер приводим к +380XXXXXXXXX, остальные оставляем как есть
            [
                'phone',
                FilterValidator::class,
                'filter' => static fn($value): string => preg_match(self::UA_PHONE_PATTERN, (string)$value)
                    ? '+380' . substr(preg_replace('/\D/', '', (string)$value), -9)
                    : (string)$value,
            ],
            ['email', EmailValidator::class],
            ['ip', SafeValidator::class],
            ['ip', IpValidator::class],
            [['website', 'formToken'], SafeValidator::class],
        ];
    }

    /**
     * @inheritDoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Ім\'я'),
            'phone' => Yii::t('app', 'Номер телефону'),
            'question' => Yii::t('app', 'Коротке питання'),
        ];
    }
}
