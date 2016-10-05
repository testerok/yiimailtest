<?php
	
namespace app\models;

use Yii;
use yii\base\Model;

class SPSendRegEmail extends Model
{
	
	public $email;
	
	/*проверяем правильно ли заполнен адрес*/
	public function rules()
	{
		return [
			['email', 'filter', 'filter' => 'trim'],
			['email', 'required'],
			['email', 'email'],
		];
	}
	
	public function attributeLabels()
	{
		return [
			'email' => 'Электронная почта'
		];
	}
	
	public function sendEmail()
	{
		return Yii::$app->mailer->compose('createUserMail', ['email' => $this->email])
			->setFrom([Yii::$app->params['supportEmail']=> Yii::$app->name.' (Отправлено роботом'])
			->setTo($this->email)
			->setSubject('Регистрация нового пользователя '.Yii::$app->name)
			->send();
	}
}
