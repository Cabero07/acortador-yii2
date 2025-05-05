<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'loginUrl' => ['site/login'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true, // Habilitar URLs amigables
            'showScriptName' => false, // Ocultar "index.php" en las URLs
            'rules' => [
                '<shortCode:\w+>' => 'link/redirect', // Ruta para redirección de enlaces acortados
                'link-stats/register-click/<linkId:\d+>' => 'link-stats/register-click',
                'user/changePassword' => 'user/change-password',
                'user/profile' => 'user/profile',
                'site/linkStats' => 'site/link-stats',
            ],
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'decimalSeparator' => '.',
            'thousandSeparator' => ',',
            'numberFormatterOptions' => [
                NumberFormatter::MIN_FRACTION_DIGITS => 4,
                NumberFormatter::MAX_FRACTION_DIGITS => 4,
            ],
        ],
    ],
    'params' => $params,
];
