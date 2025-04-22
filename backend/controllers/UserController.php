<?php

namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use common\models\User;
/**
 * Controlador para gestionar usuarios (solo accesible por administradores).
 */
class UserController extends Controller
{
    /**
     * Configura las reglas de acceso.
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['admin'], // Solo usuarios con el rol 'admin' pueden acceder
                    ],
                ],
            ],
        ];
    }

    /**
     * Acción para listar usuarios.
     */
    public function actionIndex()
    {
        // Código para listar usuarios
    }

    /**
     * Acción para deshabilitar un usuario.
     */
    public function actionDisable($id)
    {
        $user = User::findOne($id);
        if ($user) {
            $user->status = -1; // Deshabilitar usuario
            $user->save();
        }

        return $this->redirect(['index']);
    }
}