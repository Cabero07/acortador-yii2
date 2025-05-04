<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Link;
use common\models\LinkStats;
use yii\web\NotFoundHttpException;
use common\models\User;
use common\models\UserLog;
use common\models\IntermediatePage;

class LinkController extends Controller
{
    public function actionRedirect($shortCode)
    {
        try {
            $link = Link::findOne(['short_code' => $shortCode]);

            if (!$link || !$link->is_active) {
                throw new NotFoundHttpException('El enlace no existe o está inactivo.');
            }

            // Incrementar estadísticas
            $stats = LinkStats::findOne(['link_id' => $link->id]) ?? new LinkStats(['link_id' => $link->id]);
            $stats->clicks += 1;
            $stats->save();

            // Incrementar balance del propietario del enlace
            $user = $link->user;
            if ($user) {
                $user->balance += 0.004; // Ganancia por clic personal
                $user->save(false);

                $log = new UserLog([
                    'user_id' => $user->id,
                    'amount' => 0.004,
                    'action' => 'Recibir',
                    'performed_by' => $user->id,
                    'balance_after' => $user->balance,
                ]);
                $log->save();
                if (!$log->save()) {
                    Yii::error('Error al guardar el log: ' . json_encode($log->errors), __METHOD__);
                }

                // Verificar si el usuario fue referido por otro usuario
                if ($user->referrer_id) {
                    $referrer = User::findOne($user->referrer_id);
                    if ($referrer) {
                        $referrer->balance += 0.002; // Ganancia por referencia
                        $referrer->save(false);

                        $log = new UserLog([
                            'user_id' => $referrer->id,
                            'amount' => 0.002,
                            'action' => 'Recibir',
                            'performed_by' => $referrer->id,
                            'balance_after' => $referrer->balance,
                        ]);
                        $log->save();
                        if (!$log->save()) {
                            Yii::error('Error al guardar el log: ' . json_encode($log->errors), __METHOD__);
                        }
                        // Validar URL
                        if (!filter_var($link->url, FILTER_VALIDATE_URL)) {
                            throw new \Exception('La URL almacenada no es válida.');
                        }

                        // Redirección a la URL original
                        return $this->redirect($link->url);
                    }
                }
            }

            return $this->redirect($link->url); // Redirección a la URL original
        } catch (\Exception $e) {
            Yii::error('Error durante la redirección: ' . $e->getMessage(), __METHOD__);
            throw new NotFoundHttpException('Hubo un problema al procesar su solicitud.');
        }
    }
    public function actionIntermediate($shortCode)
    {
        $link = Link::findOne(['short_code' => $shortCode]);

        if (!$link) {
            throw new \yii\web\NotFoundHttpException('El enlace no existe.');
        }

        // Registrar la vista en la página intermedia
        $intermediatePage = new IntermediatePage();
        $intermediatePage->link_id = $link->id;
        $intermediatePage->views += 1;
        $intermediatePage->save();

        return $this->render('intermediate', [
            'link' => $link,
        ]);
    }
}
