<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use yii\rbac\DbManager;

class RbacController extends Controller
{
    public function actionInit()
    {
        /** @var DbManager $auth */
        $auth = Yii::$app->authManager;

        // Limpia datos existentes
        $auth->removeAll();

        // Crear permisos
        $manageUsers = $auth->createPermission('manageUsers');
        $manageUsers->description = 'Gestionar usuarios';
        $auth->add($manageUsers);

        $manageLinks = $auth->createPermission('manageLinks');
        $manageLinks->description = 'Gestionar enlaces';
        $auth->add($manageLinks);

        // Crear roles
        $user = $auth->createRole('user');
        $auth->add($user);

        $admin = $auth->createRole('admin');
        $auth->add($admin);

        // Asignar permisos a roles
        $auth->addChild($admin, $manageUsers);
        $auth->addChild($admin, $manageLinks);

        // Asignar roles a usuarios específicos
        $auth->assign($admin, 1); // Usuario con ID 1 será admin
    }
}