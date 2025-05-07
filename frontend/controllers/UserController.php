<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\ProfileForm;
use common\models\User;
use common\models\Link;
use common\models\LinkStats;
use frontend\models\PasswordChangeForm;

class UserController extends Controller
{
    public function actionProfile()
    {
        $model = new ProfileForm();
        $user = Yii::$app->user->identity;
        $passwordModel = new PasswordChangeForm();
        // Precargar valores actuales
        $model->email = $user->email;
        $model->phone_number = $user->phone_number;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->saveProfile()) {
                Yii::$app->session->setFlash('success', 'Tu perfil ha sido actualizado correctamente.');
            } else {
                Yii::$app->session->setFlash('error', 'Ocurrió un error al actualizar tu perfil.');
            }


            return $this->refresh();
        }
        if (Yii::$app->request->isPost) {
            if ($passwordModel->load(Yii::$app->request->post()) && $passwordModel->validate() && $passwordModel->changePassword()) {
                Yii::$app->session->setFlash('success', 'Contraseña cambiada exitosamente.');
                return $this->redirect(['profile']);
            }
        }

        return $this->render('profile', [
            'model' => $model,
            'passwordModel' => $passwordModel,
        ]);
    }
}
