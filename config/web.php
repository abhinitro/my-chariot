<?php
use yii\helpers\Url;

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$config = [ 
		'id' => 'chariot-cart',
		'name' => 'My Chariot',
		'basePath' => dirname ( __DIR__ ),
		'bootstrap' => [ 
				'log' 
		],
		'aliases' => [ 
				'@bower' => '@vendor/bower-asset',
				'@npm' => '@vendor/npm-asset' 
		],
		'components' => [ 
				'assetManager' => [ 
						'bundles' => [ 
								'yii\web\JqueryAsset' => [ 
										'sourcePath' => null, // do not publish the bundle
										'js' => [ 
												'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'  // use custom jquery
										
												
										] 
								] 
						] 
				],
				'request' => [ 
						// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
						'cookieValidationKey' => 'SharingCart' 
				],
				'cache' => [ 
						'class' => 'yii\caching\FileCache' 
				],
				'user' => [ 
						'identityClass' => 'app\models\User',
						'enableAutoLogin' => true 
				],
				'defaultRoute' => 'site/index',
				'errorHandler' => [ 
						'errorAction' => 'site/error' 
				],
				
				'authClientCollection' => [ 
						'class' => 'yii\authclient\Collection',
						'clients' => [ 
								'google' => [ 
										'class' => 'yii\authclient\clients\Google',
										'clientId' => '66606141943-lcegkqs94ldvfv99uo52b5sg9a94pig1.apps.googleusercontent.com',
										'clientSecret' => 'jHv5jD_v6zt5W-3sQQoW2hIR' 
								],
								'facebook' => [ 
										'class' => 'yii\authclient\clients\Facebook',
										'clientId' => '530600437334089',
										'clientSecret' => '8f8b03a2c1b12b58bf4c35473d905ae1' 
								],
								
								'twitter' => [ 
										'class' => 'yii\authclient\clients\Twitter',
										'attributeParams' => [ 
												'include_email' => 'true' 
										],
										'consumerKey' => 'UrFVapTG3moZt7RlyNfoY8P44',
										'consumerSecret' => 'bRzYZIRNg965JLWFFNGUBnkxJilBlRX7Knfi9FVhsRmxNMP3H6' 
								] 
							
							// etc.
						] 
				],
				
				'mailer' => [ 
						'class' => 'yii\swiftmailer\Mailer',
						// send all mails to a file by default. You have to set
						// 'useFileTransport' to false and configure a transport
						// for the mailer to send real emails.
						'useFileTransport' => true 
				],
				'log' => [ 
						'traceLevel' => YII_DEBUG ? 3 : 0,
						'targets' => [ 
								[ 
										'class' => 'yii\log\FileTarget',
										'levels' => [ 
												'error',
												'warning' 
										] 
								] 
						] 
				],
				'view' => [ 
						'theme' => [ 
								'pathMap' => [ 
										'@app/views' => '@app/views' 
								],
								'basePath' => '@app/themes',
								'baseUrl' => '@web/themes' 
						] 
				],
				'db' => $db,
				'urlManager' => [ 
						'class' => 'yii\web\UrlManager',
						// Disable index.php
						'showScriptName' => false,
						// Disable r= routes
						'enablePrettyUrl' => true,
						'rules' => [ 
								
								'<controller:\w+>/<id:\d+>' => '<controller>/view',
								'<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
								'<controller:\w+>/<action:\w+>' => '<controller>/<action>',	
								'<controller:\w+>/<action:\w+>' => '<controller>/<action>',
								
								'media' => 'media/default/index' 
						] 
				] 
		
		],
		'modules' => [ 
				'comingsoon' => [ 
						'class' => 'app\modules\comingsoon\Module' 
				],
				'backup' => [ 
						'class' => 'spanjeta\modules\backup\Module' 
				],
				'support' => [ 
						'class' => 'app\modules\support\Module' 
				],
				'media' => [ 
						'class' => 'app\modules\media\Module' 
				] 
		],
		'params' => $params 
];

if (YII_ENV_DEV) {
	// configuration adjustments for 'dev' environment
	$config ['bootstrap'] [] = 'debug';
	$config ['modules'] ['debug'] = [ 
			'class' => 'yii\debug\Module' 
		// uncomment the following to add your IP if you are not connecting from localhost.
		// 'allowedIPs' => ['127.0.0.1', '::1'],
	];
	
	$config ['bootstrap'] [] = 'gii';
	$config ['modules'] ['gii'] = [ 
			'class' => 'yii\gii\Module' 
		// uncomment the following to add your IP if you are not connecting from localhost.
		// 'allowedIPs' => ['127.0.0.1', '::1'],
	];
}

return $config;
