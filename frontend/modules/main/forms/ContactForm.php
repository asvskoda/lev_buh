<?php

namespace frontend\modules\main\forms;

use Yii;
use yii\base\Model;
use yii\validators\EmailValidator;
use yii\validators\RequiredValidator;
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

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                ['name', 'email', 'question','phone'],
                RequiredValidator::class,
                'message' => Yii::t('app', 'Не може бути пустим')
            ],
            [['name', 'email', 'question','phone'], 'filter', 'filter' => 'trim'],
            [['name', 'email', 'question','phone'], StringValidator::class],
            [
                'phone',
                StringValidator::class,
                'min' => 10,
                'max' => 13,
                'message' =>  Yii::t('app', 'Неправильний формат номера телефону')
            ],
            ['email', EmailValidator::class],
        ];
    }

    /**
     * {@inheritdoc}
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
