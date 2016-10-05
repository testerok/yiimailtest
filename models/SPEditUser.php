<?php
namespace app\models;

use Yii;
use yii\base\Model;

class SPEditUser extends \yii\db\ActiveRecord
{
	public static function tableName()
    {
        return 'yiiusers';
    }

	/*делаем проверку заполнения в форме редактирования*/
	public function rules(){
		return [
			[['username'], 'filter', 'filter' => 'trim'],
			[['username',], 'required'],
			['username', 'string', 'min' => 2, 'max' => 255]
		];
	}
	
	public function attributeLabels(){
		return [
			'username' => 'Ваше имя'
		];
	}
	
	public function getUser()
	{
			//var_dump(Yii::$app->user);
			return $this->findOne(User::className, ['id' => Yii::$app->user->id]);
	}
	
	public function updateUser(){
		$currUser = ($currUser = SPEditUser::findOne(Yii::$app->user->id)) ? $currUser : new SPEditUser ();
		$currUser->id = $this->id;
		$currUser->username = $this->username;
		return $currUser->save() ? true : false;
	}
}