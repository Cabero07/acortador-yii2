<?php

namespace frontend\controllers;

use Yii;
use common\models\News;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * NewsController implements the actions for displaying news in the frontend.
 */
class NewsController extends Controller
{   
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    // Permitir acceso a las acciones 'login', 'signup' y 'error' a cualquier usuario
                    [
                        'actions' => ['login', 'signup', 'error'],
                        'allow' => true,
                    ],
                    // Requerir autenticación para todas las demás acciones
                    [
                        'allow' => true,
                        'roles' => ['@'], // '@' indica que el usuario debe estar autenticado
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    return Yii::$app->response->redirect(['site/login']); // Redirigir al login si no está autenticado
                },
            ],
        ];
    }
    /**
     * Lists all News models.
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => News::find()->orderBy(['created_at' => SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single News model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the News model based on its primary key value.
     * @param int $id
     * @return News
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}