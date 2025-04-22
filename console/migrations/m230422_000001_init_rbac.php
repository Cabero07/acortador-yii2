<?php

use yii\db\Migration;

/**
 * Class m230422_000001_init_rbac
 * Inicializa los roles y permisos RBAC.
 */
class m230422_000001_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Permiso: Gestionar usuarios
        $manageUsers = $auth->getPermission('manageUsers');
        if ($manageUsers === null) {
            $manageUsers = $auth->createPermission('manageUsers');
            $manageUsers->description = 'Gestionar usuarios (habilitar/deshabilitar)';
            $auth->add($manageUsers);
        }

        // Crear roles
        $adminRole = $auth->getRole('admin');
        if ($adminRole === null) {
            $adminRole = $auth->createRole('admin');
            $adminRole->description = 'Administrador del sistema';
            $auth->add($adminRole);

            // Asignar permisos al rol admin
            $auth->addChild($adminRole, $manageUsers);
        }

        // Agregar más roles o permisos según sea necesario
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        $auth->remove($auth->getPermission('manageUsers'));
        $auth->remove($auth->getRole('admin'));
    }
}