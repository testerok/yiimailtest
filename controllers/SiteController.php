<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Session;
use app\models\SPLoginForm;
use app\models\SPSendRegEmail;
use app\models\SPCreateUser;
use app\models\SPEditUser;

class SiteController extends Controller
{
	
    /*ограничиваем видимость страниц в зависимости от авторизации******************************************************/
    public function behaviors()
    {
		return [

			/*Настраиваем правила доступа*/
			/******************************************************************************/
			'access' => [
                'class' => AccessControl::className(),
				'only' => ['edituser', 'logout', 'sendauthmail', 'loginuser'],
                'rules' => [
                    [
						'allow' => true,
						'controllers' => ['site'],
                        'actions' => ['loginuser', 'sendauthmail'],
                        'roles' => ['?'],
						'verbs' => ['GET', 'POST'],
                    ],
					[
						'allow' => true,
						'controllers' => ['site'],
                        'actions' => ['logout' , 'edituser'],
                        'roles' => ['@'],
						'verbs' => ['GET', 'POST'],
                    ],
                ]
            ]
        ];
    }
	
 
    /*действия*********************************************************************************************************/
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    } 
	 

    /*домашняя страница************************************************************************************************/
    public function actionIndex()
    {
        return $this->render('index');
    }

	
    /*авторизация пользователя по E-mail ссылке************************************************************************/
    public function actionLoginuser($email)
    {
		if (!Yii::$app->user->isGuest) { 
			return $this->redirect('/aa_yiiorig/web/index.php?r=site%2Fedituser');
        }
	
		if (Yii::$app->request->get()) {
			$model = new SPLoginForm();
			$modelData = $model->login($email);
			if (!$modelData){
				return $this->goHome();
			}    
        }else{
			return $this->goHome();
		}
		
		return $this->render('edituser', [
				'model' => $modelData
		]);
    }
	
	
	/*отправляем E-mail для авторизации********************************************************************************/
	public function actionSendauthmail()
	{
		$model = new SPSendRegEmail();

		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				if($model->sendEmail()){
					Yii::$app->getSession()->setFlash('warning', 'Проверьте почту.');
				//	return $this->goHome();	
				}
			}
		}

		return $this->render('sendauthmail', [
			'model' => $model,
		]);
	}
	
	
	/*редактирование имени пользователмя*******************************************************************************/
	public function actionEdituser()
	{
		$model = new SPEditUser();
		$model = ($model = SPEditUser::findOne(Yii::$app->user->id)) ? $model : new SPEditUser();
		
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			
			if($model->updateUser()){
				Yii::$app->session->setFlash('access', 'Профиль изменен');
			}else{
				Yii::$app->session->setFlash('warning', 'Профиль не изменен');
				Yii::error('Ошибка записи. Профиль не изменне');
				return $this->refresh();
			}
		}
		
		return $this->render('edituser', [
			'model' => $model,
		]);
	}
	
	
	/* разлогинивание *************************************************************************************************/
	public function actionLogout()
	{
		Yii::$app->user->logout(); 
		return $this->goHome();	
	}
	
}
