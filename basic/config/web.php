<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log',
        'queue1', // 第一个组件注册了自己的控制台命令
        'queue2', // 第二个组件注册了自己的控制台命令
    ],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'spYHj1loZ1ySrDIdYOX2WudBnzcs9E6K',
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
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,

        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

        'queue1' => [
            'class' => \yii\queue\db\Queue::class,
            'db' => 'db', // DB 连接组件或它的配置
            'tableName' => '{{%queue}}', // 表名
            'channel' => 'default1', // Queue channel key
            'mutex' => \yii\mutex\MysqlMutex::class, // Mutex that used to sync queries
            'as log' => \yii\queue\LogBehavior::class
        ],
        'queue2' => [
            'class' => \yii\queue\db\Queue::class,
            'db' => 'db', // DB 连接组件或它的配置
            'tableName' => '{{%queue}}', // 表名
            'channel' => 'default2', // Queue channel key
            'mutex' => \yii\mutex\MysqlMutex::class, // Mutex that used to sync queries
            'as log' => \yii\queue\LogBehavior::class
        ],
    ],
    'params' => $params,
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
