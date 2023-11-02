<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => '1000',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'admin\controllers',
    'bootstrap' => ['log'],
    'homeUrl' => ['default/index'],
    'modules' => [
        'auth' => [
            'class' => 'common\modules\auth\Module',
        ],
    ],
    'components' => [
        'request' => [
            
            'csrfParam' => '_csrf-admin',
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
           // 'cookieValidationKey' => 'YYRUZjg0z3S7YE8rRTK05oHqHPbyJcts',
        ],
        'user' => [
            'identityClass' => 'common\models\auth\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-admin',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManagerCommon' => [
            'class' => 'yii\web\UrlManager',
            'baseUrl' => '/common/modules',
            'enablePrettyUrl' => false,
            'showScriptName' => false,
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'defaultRoute' => 'default',
    'params' => $params,
];



