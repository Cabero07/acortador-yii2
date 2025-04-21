<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use common\models\User;

/**
 * RoleController manages user roles.
 */
class RoleController extends Controller
{
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
     * Lista todos los usuarios y sus roles actuales.
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Asigna un rol a un usuario.
     */
    public function actionAssign($id)
    {
        $auth = Yii::$app->authManager;
        $user = User::findOne($id);

        if ($user === null) {
            throw new \yii\web\NotFoundHttpException('Usuario no encontrado.');
        }

        if (Yii::$app->request->post()) {
            $roleName = Yii::$app->request->post('role');
            $role = $auth->getRole($roleName);

            if ($role === null) {
                Yii::$app->session->setFlash('error', 'No se encontró el rol.');
            } else {
                $auth->revokeAll($id); // Revocar roles actuales
                $auth->assign($role, $id); // Asignar nuevo rol
                Yii::$app->session->setFlash('success', "Rol '{$roleName}' asignado al usuario.");
            }

            return $this->redirect(['index']);
        }

        $roles = $auth->getRoles();
        return $this->render('assign', [
            'user' => $user,
            'roles' => $roles,
        ]);
    }
}