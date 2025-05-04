<?php

namespace backend\controllers;

use Yii;
use common\models\WithdrawRequest;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

class WithdrawController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => WithdrawRequest::find()
                ->joinWith('user') // Para incluir los datos del usuario
                ->where(['!=', 'withdraw_requests.status', 'completado']) // Especificar la tabla explícitamente
                ->orderBy(['withdraw_requests.created_at' => SORT_DESC]), // Prefijo también para ordenar
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionUpdateStatus($id, $status)
    {
        $model = WithdrawRequest::findOne($id);

        if ($model && in_array($status, ['pendiente', 'aprobado', 'completado'])) {
            $model->status = $status;
            $model->save();
            Yii::$app->session->setFlash('success', 'Estado actualizado.');
        }

        return $this->redirect(['index']);
    }
}
