<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

class CreateAdminController extends Controller
{
    /**
     * Crea un usuario administrador.
     *
     * @param string $username Nombre de usuario.
     * @param string $email Correo electrónico del usuario.
     * @param string $password Contraseña del usuario.
     */
    public function actionIndex($username, $email, $password)
    {
        $user = new User();
        $user->username = $username;
        $user->email = $email;
        $user->setPassword($password);
        $user->generateAuthKey();

        if ($user->save()) {
            $auth = Yii::$app->authManager;
            $adminRole = $auth->getRole('admin');

            if ($adminRole === null) {
                $adminRole = $auth->createRole('admin');
                $auth->add($adminRole);
            }

            $auth->assign($adminRole, $user->id);

            echo "Usuario administrador creado exitosamente.\n";
        } else {
            echo "Error al crear el usuario administrador:\n";
            foreach ($user->errors as $error) {
                echo "- $error\n";
            }
        }
    }
}