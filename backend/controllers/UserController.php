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
        $user = User::findOne($id);

        if (!$user) {
            Yii::$app->session->setFlash('error', 'Usuario no encontrado.');
            return $this->redirect(['manage']);
        }

        // Validar que el rol es válido
        if (!in_array($roleName, ['user', 'admin'])) {
            Yii::$app->session->setFlash('error', "El rol '{$roleName}' no es válido.");
            return $this->redirect(['manage']);
        }

        // Actualizar el rol del usuario
        $user->role = $roleName;
        if ($user->save(false)) { // Guardar sin validación adicional
            Yii::$app->session->setFlash('success', "Rol cambiado a '{$roleName}' con éxito.");
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo cambiar el rol del usuario.');
        }
        $log = new UserLog([
            'user_id' => $user->id,
            'action' => $roleName ? "Rol cambiado a {$roleName} " : '',
            'performed_by' => Yii::$app->user->id,
        ]);

        if (!$log->save()) {
            Yii::error('Error al guardar el log: ' . json_encode($log->errors), __METHOD__);
        }

        return $this->redirect(['manage']);
    }
    public function actionRanking()
    {
        // Obtener el ranking de usuarios por visitas
        $usersByVisits = User::find()
            ->alias('u')
            ->select([
                'u.username',
                'total_clicks' => 'SUM(ls.clicks)',
            ])
            ->leftJoin('links l', 'l.user_id = u.id')
            ->leftJoin('link_stats ls', 'ls.link_id = l.id')
            ->groupBy('u.id')
            ->orderBy(['total_clicks' => SORT_DESC])
            ->limit(10)
            ->asArray()
            ->all();

        // Obtener el ranking de usuarios por referidos dentro de la tabla `user`
        $usersByReferrals = User::find()
            ->alias('u')
            ->select([
                'u.username',
                'total_referrals' => 'COUNT(ref.id)', // Calcula la cantidad de referidos
            ])
            ->leftJoin('user ref', 'ref.referrer_id = u.id') // Relación con la misma tabla
            ->groupBy('u.id')
            ->orderBy(['total_referrals' => SORT_DESC])
            ->limit(10)
            ->asArray()
            ->all();

        return $this->render('ranking', [
            'usersByVisits' => $usersByVisits,
            'usersByReferrals' => $usersByReferrals,
        ]);
    }
    /**
     * Elimina una cuenta de usuario.
     * @param int $id ID del usuario a eliminar.
     * @return \yii\web\Response
     */
    public function actionDeleteAccount($id)
    {
        $user = User::findOne($id);

        if (!$user) {
            Yii::$app->session->setFlash('error', 'Usuario no encontrado.');
            return $this->redirect(['manage']);
        }

        // Evitar que un administrador se elimine a sí mismo
        if ($user->id === Yii::$app->user->id) {
            Yii::$app->session->setFlash('error', 'No puedes eliminar tu propia cuenta.');
            return $this->redirect(['manage']);
        }

        // Eliminar el usuario
        if ($user->delete()) {
            Yii::$app->session->setFlash('success', 'Usuario eliminado con éxito.');
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo eliminar la cuenta del usuario.');
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
        $log = new UserLog([
            'user_id' => $user->id,
            'action' => $status ? 'Usuario habilitado' : 'Usuario deshabilitado',
            'performed_by' => Yii::$app->user->id,
        ]);

        if (!$log->save()) {
            Yii::error('Error al guardar el log: ' . json_encode($log->errors), __METHOD__);
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
