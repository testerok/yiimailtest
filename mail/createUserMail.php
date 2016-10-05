<?php
	
use yii\helpers\Html;

//echo 'Привет '.Html::encode($user->username).'. ';
echo 'Привет '.Html::encode('user').'. ';
echo Html::a('Create new user account.',
	Yii::$app->urlManager->createAbsoluteUrl(
		[
			'/site/loginuser',
			'email' => $email
		]
	)
);