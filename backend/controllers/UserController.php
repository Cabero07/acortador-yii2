<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use yii\filters\AccessControl;
use common\models\UserLog;

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

    try {
        // Eliminar todos los roles actuales y asignar el nuevo rol
        $auth->revokeAll($user->id);
        $auth->assign($role, $user->id);

        // Registrar en el log
        $log = new UserLog([
            'user_id' => $user->id,
            'action' => "Rol cambiado a '{$roleName}'",
            'performed_by' => Yii::$app->user->id,
        ]);
        $log->save();

        Yii::$app->session->setFlash('success', "Rol cambiado a '{$roleName}' con éxito.");
    } catch (\Exception $e) {
        Yii::$app->session->setFlash('error', 'No se pudo cambiar el rol del usuario: ' . $e->getMessage());
    }

    return $this->redirect(['manage']);
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
        return $this->redirect(['manage']);
    }

    $user->status = $status;
    if ($user->save(false)) { // Saltamos la validación para evitar conflictos
        $statusText = $status ? 'habilitado' : 'deshabilitado';
        Yii::$app->session->setFlash('success', "Usuario {$statusText} con éxito.");
    } else {
        Yii::$app->session->setFlash('error', 'No se pudo actualizar el estado del usuario.');
    }

    return $this->redirect(['manage']);
}

    public function actionLogs()
    {
        $logs = UserLog::find()
            ->with(['user', 'performedBy']) // Incluye relaciones para evitar múltiples consultas
            ->orderBy(['created_at' => SORT_DESC]) // Ordenar por fecha descendente
            ->all();

        return $this->render('logs', [
            'logs' => $logs,
        ]);
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
