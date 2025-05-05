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

        // Establecemos manualmente el rol de administrador
        $user->role = 'admin';
        
        // (Opcional) Si tu modelo lo requiere, puedes asignar otros atributos adicionales:
        // $user->referrer_id = null;  // Si aplica
        // $user->access_token = null; // Se mantiene nulo
        // $user->profile_picture = null;
        // $user->verification_token = null;
         $user->phone_number = "+5641531534";
        // Los campos como `status`, `created_links_count`, `balance`, `created_at` y `updated_at`
        // se llenan automáticamente por la definición de la tabla.

        if ($user->save()) {
            // Asignamos el rol "admin" usando el authManager de Yii si estás utilizando RBAC
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
            foreach ($user->errors as $attribute => $errors) {
                echo "- {$attribute}: " . implode(', ', $errors) . "\n";
            }
        }
        
    }
}
