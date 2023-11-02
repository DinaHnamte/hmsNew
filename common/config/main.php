<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'bootstrap' => ['debug'],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'modules' => [
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
        'debug' => 'yii\debug\Module',
    ],
    'components' => [
        'timeUtils' => [
            'class' => 'common\components\TimeUtils',
        ],
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',            
            'defaultRoles' => ['guest', 'user', 'admin'],
            // uncomment if you want to cache RBAC items hierarchy
            // 'cache' => 'cache',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'YYRUZjg0z3S7YE8rRTK05oHqHPbyJcts',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            // Disable index.php
            'showScriptName' => false,
            'enablePrettyUrl' => true,
            'rules' => array(
               '<controller:\w+>/<id:\d+>' => '<controller>/view',
               '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
               '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
               'debug/<controller>/<action>' => 'debug/<controller>/<action>',
            ),
         ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'google' => [
                    'class' => 'yii\authclient\clients\Google',
                    'clientId' => '216900862310-b75pau8502feh9ni3v1oto19ndguosnc.apps.googleusercontent.com',
                    'clientSecret' => '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',
                    'returnUrl' => 'http://localhost/site/auth?authclient=google',
                ],
                'facebook' => [
                    'class' => 'yii\authclient\clients\Facebook',
                    'clientId' => '1602267293176211',
                    'clientSecret' => '7732272c6d2645b49f8ecc3de2495fb1',
                ],
                // etc.
            ],
        ],
    ],
];


