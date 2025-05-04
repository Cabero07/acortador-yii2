<?php

namespace frontend\controllers;

use Yii;
use common\models\WithdrawRequest;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\data\ActiveDataProvider;

class WithdrawController extends Controller
{
    public function actionCreate()
    {
        $model = new WithdrawRequest();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id = Yii::$app->user->id;
            $model->status = 'pendiente';

            if ($model->validate()) {
                $model->deductUserBalance(); // Deduce balance before saving
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Solicitud de retiro enviada.');
                    return $this->redirect(['site/index']);
                }
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => WithdrawRequest::find()
                ->where(['user_id' => Yii::$app->user->id])
                ->orderBy(['created_at' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }
}