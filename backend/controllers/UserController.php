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
    public function actionManage()
    {
        $query = User::find();

        // Aplicar filtros de búsqueda
        $search = Yii::$app->request->get('search', null);
        $filterStatus = Yii::$app->request->get('status', null);
        $filterRole = Yii::$app->request->get('role', null);

        // Filtro de búsqueda por nombre o correo
        if (!empty($search)) {
            $query->andFilterWhere([
                'or',
                ['like', 'username', $search],
                ['like', 'email', $search],
            ]);
        }

        // Filtro por estado (habilitado/deshabilitado)
        if ($filterStatus !== null && $filterStatus !== '') {
            $query->andWhere(['status' => (int)$filterStatus]);
        }

        // Filtro por rol
        if (!empty($filterRole)) {
            $auth = Yii::$app->authManager;
            $userIdsWithRole = $auth->getUserIdsByRole($filterRole);
            $query->andWhere(['id' => $userIdsWithRole]);
        }

        $users = $query->all(); // Obtener usuarios según filtros
        $auth = Yii::$app->authManager;
        $roles = $auth->getRoles(); // Obtener todos los roles disponibles

        return $this->render('manage', [
            'users' => $users,
            'roles' => $roles,
            'search' => $search,
            'filterStatus' => $filterStatus,
            'filterRole' => $filterRole,
        ]);
    }
}