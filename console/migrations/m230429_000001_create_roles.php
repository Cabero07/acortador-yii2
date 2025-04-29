<?php

use yii\db\Migration;

/**
 * Class m230429_000001_create_roles
 */
class m230429_000001_create_roles extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Crear el rol "user" si no existe
        if (!$auth->getRole('user')) {
            $userRole = $auth->createRole('user');
            $userRole->description = 'Usuario regular';
            $auth->add($userRole);
        }

        // Crear el rol "admin" si no existe
        if (!$auth->getRole('admin')) {
            $adminRole = $auth->createRole('admin');
            $adminRole->description = 'Administrador';
            $auth->add($adminRole);
        }
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        // Eliminar roles si existen
        if ($auth->getRole('user')) {
            $auth->remove($auth->getRole('user'));
        }

        if ($auth->getRole('admin')) {
            $auth->remove($auth->getRole('admin'));
        }
    }
}