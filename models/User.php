<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
use yii\behaviors\TimestampBehavior;


class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
  
	public static function tableName()
    {
        return 'yiiusers';
    }

    /*правила для внешней формы не нужны форма не используеться*/
    public function rules()
    {
        return [];
    } 

    /*изменияем надписи*/
    public function attributeLabels()
    {
        return [
        ];
    }

	
	/*оставляем 5 стандартных методов Yii которые должны присутствовать в модели пользователя**************************/
	 public static function findIdentity($id)
    {
        return static::findOne([
			'id' => $id,
		]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
	
	public static function findByEmail($email)
	{
		return static::findOne([
			'email' => $email
		]);
	}
	
    public function getId() 
    {
        return $this->id;
    }
 
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
}
