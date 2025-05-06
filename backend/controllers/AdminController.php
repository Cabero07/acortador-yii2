<?php

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use backend\models\AdminOptions;

class AdminController extends Controller
{
    public function actionOptions()
    {
        $model = new AdminOptions();
        $model->loadSettings();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            Yii::$app->session->setFlash('success', 'Opciones guardadas correctamente.');
            return $this->refresh();
        }

        return $this->render('options', [
            'model' => $model,
        ]);
    }
}