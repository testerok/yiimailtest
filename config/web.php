<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
	
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'oO2FUm41OunxXvFO9lqOSdysKS6LVxqT', /*генерируем ключ для куки*/
        ],
		
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
		
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
		
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
		
		/*настраиваем отправку через внешний адрес*/
		'mail' => [
        'class' => 'yii\swiftmailer\Mailer',
        'useFileTransport' => true,
        'transport' => [
            'class' => 'Swift_SmtpTransport',
            'host' => 'smtp.mail.net',
            'username' => 'username@test.com',
            'password' => 'password',
            'port' => '465',
            'encryption' => 'tls',
            ],
		],	
		
		/*комментим стандартные настройки*/
        /*'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],*/
		
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
		
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
		'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.*', '2.2.2.2'] /*добавляем свой IP адрес в список разрешенных для отладки*/
    ];
}

return $config;
