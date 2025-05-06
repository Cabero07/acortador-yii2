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
        'settings' => [
            'class' => 'common\components\SettingsComponent', // Componente para manejar configuraciones
        ],
        
    ],
];
