<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => \yii\caching\FileCache::class,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // Usa la base de datos para almacenar roles y permisos
        ],
        'user' => [
            'identityClass' => 'common\models\User', // Asegúrate de que esta clase sea correcta
            'enableAutoLogin' => true,
        ],
        
    ],
];
