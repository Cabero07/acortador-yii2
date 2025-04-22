<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use common\models\User;

/**
 * Controlador para gestionar usuarios y roles en el backend.
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
     * Lista y gestiona usuarios y roles.
     */
    public function actionManage()
    {
        $users = User::find()->all(); // Obtiene todos los usuarios
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles(); // Obtiene todos los roles disponibles

        return $this->render('manage', [
            'users' => $users,
            'roles' => $roles,
        ]);
    }

    /**
     * Cambia el estado (habilitar/deshabilitar) de un usuario.
     * @param int $id ID del usuario.
     * @param int $status Nuevo estado del usuario (1 = habilitado, 0 = deshabilitado).
     */
    public function actionToggleStatus($id, $status)
    {
        $user = User::findOne($id);

        if (!$user) {
            Yii::$app->session->setFlash('error', 'Usuario no encontrado.');
            return $this->redirect(['manage']);
        }

        $user->status = $status;
        if ($user->save()) {
            $statusText = $status ? 'habilitado' : 'deshabilitado';
            Yii::$app->session->setFlash('success', "Usuario {$statusText} con éxito.");
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo actualizar el estado del usuario.');
        }

        return $this->redirect(['manage']);
    }

    /**
     * Cambia el rol de un usuario.
     * @param int $id ID del usuario.
     * @param string $roleName Nuevo rol a asignar.
     */
    public function actionChangeRole($id, $roleName)
    {
        $auth = Yii::$app->authManager;
        $user = User::findOne($id);

        if (!$user) {
            Yii::$app->session->setFlash('error', 'Usuario no encontrado.');
            return $this->redirect(['manage']);
        }

        $role = $auth->getRole($roleName);
        if (!$role) {
            Yii::$app->session->setFlash('error', "El rol '{$roleName}' no existe.");
            return $this->redirect(['manage']);
        }

        // Eliminar todos los roles actuales y asignar el nuevo rol
        $auth->revokeAll($user->id);
        $auth->assign($role, $user->id);

        Yii::$app->session->setFlash('success', "Rol cambiado a '{$roleName}' con éxito.");
        return $this->redirect(['manage']);
    }
}