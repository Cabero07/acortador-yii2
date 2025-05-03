<?php

namespace backend\controllers;

use Yii;
use backend\models\Link;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * LinkController implements the CRUD actions for Link model.
 */
class LinkController extends Controller
{
    public function actionIndex()
    {
        $query = Link::find();
        $filter = Yii::$app->request->get('filter', 'inactive');

        if ($filter === 'active') {
            $query->where(['is_active' => 1]);
        } else {
            $query->where(['is_active' => 0]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'filter' => $filter,
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

    public function actionDelete($id)
    {
        $link = Link::findOne($id);
        if ($link) {
            $link->delete();
            Yii::$app->session->setFlash('success', 'Link deleted successfully.');
        }

        return $this->redirect(['index']);
    }
}