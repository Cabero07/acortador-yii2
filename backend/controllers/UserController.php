<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use yii\filters\AccessControl;

/**
 * Controlador para gestionar usuarios en el backend.
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
                        'roles' => ['admin'], // Solo los administradores tienen acceso
                    ],
                ],
            ],
        ];
    }

    /**
     * Lista todos los usuarios.
     */
    public function actionIndex()
    {
        $users = User::find()->all(); // Obtiene todos los usuarios
        return $this->render('index', ['users' => $users]);
    }

    /**
     * Habilita o deshabilita un usuario.
     * @param int $id ID del usuario.
     * @param int $status Nuevo estado del usuario (1 = habilitado, 0 = deshabilitado).
     */
    public function actionToggleStatus($id, $status)
    {
        $user = User::findOne($id);

        if (!$user) {
            Yii::$app->session->setFlash('error', 'Usuario no encontrado.');
            return $this->redirect(['index']);
        }

        $user->status = $status;
        if ($user->save()) {
            $statusText = $status ? 'habilitado' : 'deshabilitado';
            Yii::$app->session->setFlash('success', "Usuario {$statusText} con éxito.");
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo actualizar el estado del usuario.');
        }

        return $this->redirect(['index']);
    }
}