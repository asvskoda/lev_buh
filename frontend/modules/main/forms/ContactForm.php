<?php

namespace frontend\modules\main\forms;

use Yii;
use yii\base\Model;
use yii\validators\EmailValidator;
use yii\validators\FilterValidator;
use yii\validators\IpValidator;
use yii\validators\RequiredValidator;
use yii\validators\SafeValidator;
use yii\validators\StringValidator;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $question;
    public $phone;
    public $ip;

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
            ['ip', SafeValidator::class],
            ['ip', IpValidator::class],
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
