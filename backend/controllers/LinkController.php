<?php

namespace backend\controllers;

use Yii;
use backend\models\Link;
use yii\data\ActiveDataProvider;
use yii\web\Controller;

/**
 * LinkController implements the CRUD actions for Link model.
 */
class LinkController extends Controller
{
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Link::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionActivate($id)
    {
        $link = Link::findOne($id);
        if ($link) {
            $link->is_active = 1;
            $link->save();
            Yii::$app->session->setFlash('success', 'Link activated successfully.');
        }

        return $this->redirect(['index']);
    }

    public function actionDeactivate($id)
    {
        $link = Link::findOne($id);
        if ($link) {
            $link->is_active = 0;
            $link->save();
            Yii::$app->session->setFlash('success', 'Link deactivated successfully.');
        }

        return $this->redirect(['index']);
    }
}