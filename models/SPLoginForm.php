<?php

namespace app\models;

use Yii;
use yii\base\Model;

class SPLoginForm extends Model
{
    private $_user = null;
	
	
	public function rules()
	{
		return [];
	}
	
	
	public function validatePassword($attribute, $params)
    {
    }
	
	
    public function login($email) 
    {
		if ($this->_user = User::findByEmail($email)){
			if (Yii::$app->user->login($this->_user)){
				return $this->_user;
			}else{
				return null;
			}
		}else{
			$this->_user = $this->reg($email);
			Yii::$app->user->login($this->_user);
			return $this->_user;
		}
    }

	
	public function reg($email)
	{
		$user = new User();
		$user->username = current(explode('@', $email));
		$user->email = $email;
		
		return $user->save() ? $user : null;
	}
	
}
