<?php
	
use yii\helpers\Html;

//echo '������ '.Html::encode($user->username).'. ';
echo '������ '.Html::encode('user').'. ';
echo Html::a('Create new user account.',
	Yii::$app->urlManager->createAbsoluteUrl(
		[
			'/site/loginuser',
			'email' => $email
		]
	)
);