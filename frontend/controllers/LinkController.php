<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Link;
use common\models\LinkStats;
use yii\web\NotFoundHttpException;
use common\models\User;

class LinkController extends Controller
{
    public function actionRedirect($shortCode)
    {
        $link = Link::findOne(['short_code' => $shortCode]);

        if ($link) {
            // Incrementar estadísticas
            $stats = LinkStats::findOne(['link_id' => $link->id]);

            if (!$stats) {
                $stats = new LinkStats(['link_id' => $link->id]);
            }

            $stats->clicks += 1;
            $stats->save();

            // Incrementar balance del propietario del enlace
            $user = $link->user;
            if ($user) {
                $user->balance += 0.004; // Ganancia por clic personal
                $user->save(false);

                // Verificar si el usuario fue referido por otro usuario
                if ($user->referrer_id) {
                    $referrer = User::findOne($user->referrer_id);
                    if ($referrer) {
                        $referrer->balance += 0.002; // Ganancia por referencia
                        $referrer->save(false);
                    }
                }
            }

            return $this->redirect($link->url); // Redirección a la URL original
        }

        throw new NotFoundHttpException('El enlace no existe.');
    }
}
