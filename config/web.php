<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
    ],
    'components' => [
        'OtherFunctionsComponent' => [
            'class' => 'app\components\OtherFunctionsComponent',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sT+W=/8@qGL`kARLE.;Z(toGJ?zHb0',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['info'],
                    'logFile' => '@runtime/logs/info.log',
                    'logVars' => [],
                    'categories' => ['info']
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'user/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                '' => 'page/home',
                'login' => 'user/login',
                'register' => 'user/register',
                'logout' => 'user/logout',
                'remind-password' => 'user/rempass',
                'remind-password-set/<UserId:\d+>/<UserHash1:[\w\-]+>/<UserHash2:[\w\-]+>' => 'user/rempassset',
                'profile' => 'user/profile',
                'activate/<UserId:\d+>/<UserKey:[\w\-]+>' => 'user/activate',
                'right' => 'user/right',
                'page/<PageUrl:[\w\-]+>/<PageId:\d+>' => 'page/showone',
                'page' => 'page/index',
                'event/<EventUrl:[\w\-]+>/<EventId:\d+>' => 'event/showone',
                'event' => 'event/index',
                'news/<NewsUrl:[\w\-]+>/<NewsId:\d+>' => 'news/showone',
                'news' => 'news/index',
                'admin' => 'configadmin/index',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>'
            ],
        ],
//        'view' => [
//            'theme' => [
//                'pathMap' => [
//                    '@app/views' => '@vendor/hail812/yii2-adminlte3/src/views'
//                ],
//            ],
//        ],
    ],
    'params' => $params,
    'language' => 'pl',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
