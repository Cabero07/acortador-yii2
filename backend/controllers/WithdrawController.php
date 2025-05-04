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
                ->where(['!=', 'withdraw_requests.status', 'completado'])
                ->andWhere(['!=', 'withdraw_requests.status', 'rechazado'])
                ->orderBy(['withdraw_requests.created_at' => SORT_DESC]), 
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

            if ($status === 'rechazado') {
                $model->refundUserBalance(); // Refund user balance if rejected
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Estado actualizado.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'No se pudo actualizar el estado.');
        }

        return $this->redirect(['index']);
    }

    public function actionReject($id)
    {
        $model = WithdrawRequest::findOne($id);

        if ($model && $model->status === 'pendiente') {
            $model->status = 'rechazado';
            $model->refundUserBalance(); // Refund user if rejected
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Solicitud de retiro rechazada.');
            } else {
                Yii::$app->session->setFlash('error', 'Error al rechazar la solicitud.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'La solicitud no puede ser rechazada.');
        }

        return $this->redirect(['index']);
    }
}