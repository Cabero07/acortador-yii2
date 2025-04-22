<?php

use yii\db\Migration;

/**
 * Class m230422_000001_init_rbac
 * Configura las reglas RBAC iniciales, incluyendo roles y permisos.
 */
class m230422_000001_init_rbac extends Migration
{
    public function safeUp()
    {
        $auth = Yii::$app->authManager;

        // Crear permisos
        $manageBackend = $auth->createPermission('manageBackend');
        $manageBackend->description = 'Acceso al backend';
        $auth->add($manageBackend);

        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Gestionar usuarios (habilitar/deshabilitar)';
        $auth->add($manageUsers);

        $useAdvancedFeatures = $auth->createPermission('useAdvancedFeatures');
        $useAdvancedFeatures->description = 'Acceso a características avanzadas';
        $auth->add($useAdvancedFeatures);

        $useBasicFeatures = $auth->createPermission('useBasicFeatures');
        $useBasicFeatures->description = 'Acceso a características básicas';
        $auth->add($useBasicFeatures);

        // Crear roles
        $admin = $auth->createRole('admin');
        $admin->description = 'Administrador con acceso completo';
        $auth->add($admin);
        $auth->addChild($admin, $manageBackend);
        $auth->addChild($admin, $manageUsers);

        $userplus = $auth->createRole('userplus');
        $userplus->description = 'Usuario con acceso a características avanzadas';
        $auth->add($userplus);
        $auth->addChild($userplus, $useAdvancedFeatures);

        $user = $auth->createRole('user');
        $user->description = 'Usuario básico';
        $auth->add($user);
        $auth->addChild($user, $useBasicFeatures);

        // Asignar permisos básicos a roles
        $auth->addChild($admin, $userplus); // Admin tiene acceso a todo lo de userplus
        $auth->addChild($userplus, $user); // userplus tiene acceso a todo lo de user
    }

    public function safeDown()
    {
        $auth = Yii::$app->authManager;

        // Eliminar roles y permisos
        $auth->removeAll();
    }
}