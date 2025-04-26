<?php

namespace backend\controllers;

use common\models\LoginForm;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {

        return [
            'access' => [
                'class' => \yii\filters\AccessControl::class,
                'rules' => [
                    // Permitir acceso a las acciones 'login' y 'error' a cualquier usuario
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    // Permitir acceso a las acciones 'logout' y 'index' solo a usuarios con el rol 'admin'
                    [
                        'actions' => ['logout', 'index', 'settings'],
                        'allow' => true,
                        'roles' => ['@'], // '@' indica que el usuario debe estar autenticado
                    ],
                ],
            ],
            'verbs' => [
                'class' => \yii\filters\VerbFilter::class,
                'actions' => [
                    // Restringir el método HTTP para la acción 'logout' a solo POST
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    /**
     * Settings action.
     * Permite a los administradores gestionar configuraciones generales de la aplicación.
     *
     * @return string|Response
     */
    public function actionSettings()
    {
        $model = new \backend\models\SettingsForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Configuraciones guardadas correctamente.');
            return $this->refresh();
        }

        return $this->render('settings', [
            'model' => $model,
        ]);
    }
    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
