<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    //require __DIR__ . '/params-local.php'
);

return [
    'id' => '1001',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'hospital\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-hospital',
        ],
        'user' => [
            'identityClass' => 'common\models\auth\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-hospital', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-hospital',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
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
    'modules' => [
        'rbac' => [
            'class' => 'yii2mod\rbac\Module',
        ],
        'auth' => [
            'class' => 'common\modules\auth\Module',
        ],
        'userspage' => [
            'class' => 'common\modules\userspage\Module',
            'defaultUrl' => '',
            'defaultUrlLabel' => '',
        ],
        'patient' => [
            'class' => 'common\modules\patient\Module',
            'defaultUrl' => '',
            'defaultUrlLabel' => '',
        ],        
        'opd' => [
            'class' => 'common\modules\encounters\Module',
            'defaultUrl' => '',
            'defaultUrlLabel' => '',
            'encounterType' => 'OPD',
        ],
        'ipd' => [
            'class' => 'hospital\modules\ipd\Module',
        ],
        'icd10' => [
            'class' => 'hospital\modules\icd10\Module',
        ],
        'doctor' => [
            'class' => 'common\modules\doctor\Module',
            'defaultUrl' => '',
            'defaultUrlLabel' => '',
        ],
        'medicine' => [
            'class' => 'hospital\modules\medicine\Module',
        ],
        'admin' => [
            'class' => 'hospital\modules\admin\Module',
        ],
        'diseases' => [
            'class' => 'hospital\modules\diseases\Module',
        ],
        'tenantadmin' => [
            'class' => 'hospital\modules\tenantadmin\Module',
        ],
    ],
    'params' => $params,
];
