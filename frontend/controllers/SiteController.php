<?php

namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use common\models\LinkStats;
use common\models\User;
use common\models\Link;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\data\ActiveDataProvider; // Importar correctamente la clase
use yii\web\NotFoundHttpException;
use common\models\News;
use common\models\UserLog;


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
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

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
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionSupport()
    {
        return $this->render('support');
    }
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($user = $model->signup()) {
                Yii::$app->session->setFlash('success', '¡Registro exitoso!');
                return $this->redirect(['login']);
            } else {
                Yii::$app->session->setFlash('error', 'Hubo un problema al crear tu cuenta. Inténtalo de nuevo.');
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    public function actionFaq()
    {
        return $this->render('faq');
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    public function actionActivity()
    {
        $logs = UserLog::find()
            ->orderBy(['created_at' => SORT_DESC])
            ->all();
        $userId = Yii::$app->user->id;
        return $this->render('activity', [
            'logs' => $logs,
            'userId' => $userId,
        ]);
    }
    public function actionWithdrawn()
    {
        $userId = Yii::$app->user->id;
        $user = User::findOne($userId);

        if (!$user) {
            throw new NotFoundHttpException('Usuario no encontrado.');
        }

        if ($user->balance < 10) {
            Yii::$app->session->setFlash('error', 'No tienes suficiente balance para realizar un retiro. El balance mínimo requerido es de $10.');
        }

        if (Yii::$app->request->isPost) {
            $amount = Yii::$app->request->post('amount');

            if ($amount <= 0 || $amount > $user->balance) {
                Yii::$app->session->setFlash('error', 'El monto ingresado no es válido.');
            } elseif ($amount < 10) {
                Yii::$app->session->setFlash('error', 'El monto mínimo para retirar es de $10.');
            } else {
                // Descontar el balance
                $user->balance -= $amount;
                if ($user->save(false)) {
                    // Registrar en user_log
                    $log = new UserLog();
                    $log->user_id = $userId;
                    $log->action = 'Retirar';
                    $log->amount = -$amount;
                    $log->balance_after = $user->balance;
                    $log->performed_by = $userId;
                    $log->created_at = date('Y-m-d H:i:s');
                    $log->save(false);

                    Yii::$app->session->setFlash('success', 'Retiro realizado exitosamente.');
                } else {
                    Yii::$app->session->setFlash('error', 'Ocurrió un error al procesar el retiro.');
                }

                return $this->redirect(['activity']);
            }
        }

        return $this->render('withdrawn', [
            'user' => $user,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }
    public function actionDelete($id)
    {
        // Buscar el modelo del enlace
        $model = Link::findOne($id);

        // Verificar si el modelo existe y pertenece al usuario actual
        if (!$model || $model->user_id !== Yii::$app->user->id) {
            throw new NotFoundHttpException('El enlace no existe o no tienes permiso para eliminarlo.');
        }

        // Eliminar el enlace
        $model->delete();

        // Redirigir a la lista de enlaces con un mensaje de éxito
        Yii::$app->session->setFlash('success', 'Enlace eliminado correctamente.');
        return $this->redirect(['links']);
    }
    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
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
    public function actionLinks()
    {
        $userId = Yii::$app->user->id;

        $dataProvider = new ActiveDataProvider([
            'query' => Link::find()->where(['user_id' => $userId]),
            'pagination' => [
                'pageSize' => 10, // Paginación con 10 elementos por página
            ],
        ]);

        return $this->render('links', [
            'dataProvider' => $dataProvider,
        ]);
    }
    public function actionShorten()
    {
        $model = new Link();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Generar un código único
            $model->short_code = Yii::$app->security->generateRandomString(6);

            // Guardar el enlace en la base de datos
            if ($model->save()) {
                Yii::$app->session->setFlash('success', "¡Enlace acortado! Aquí está tu enlace: <a href='/link/redirect?shortCode={$model->short_code}' target='_blank'>localhost/{$model->short_code}</a>");
            } else {
                Yii::$app->session->setFlash('error', 'Hubo un problema al guardar tu enlace.');
            }
        } else {
            Yii::$app->session->setFlash('error', 'Por favor, introduce una URL válida.');
        }

        return $this->redirect(['site/index']);
    }
    public function actionCreateLink()
    {
        $model = new Link();

        if ($model->load(Yii::$app->request->post())) {
            // Asignar el ID del usuario autenticado al modelo
            $model->user_id = Yii::$app->user->id;

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Enlace acortado creado exitosamente.');
                return $this->redirect(['site/links']);
            }
        }

        return $this->render('create-link', [
            'model' => $model,
        ]);
    }
    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Revise su correo para las instrucciones.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Lo sentimos, no pudimos enviar el correo de verificación intente más tarde.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}
