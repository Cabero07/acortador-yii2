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
            //incrementa el balance del usuario en 0.0042
            $user = $link->user;
            $user->balance += 0.0042;
            $user->save();

            return $this->redirect($link->url); // Redirección a la URL original
        }

        throw new NotFoundHttpException('El enlace no existe.');
    }
    public function actionTrack($linkId)
    {
        // Encuentra el enlace por su ID
        $link = Link::findOne($linkId);
        if (!$link) {
            return $this->asJson(['success' => false, 'message' => 'El enlace no existe.']);
        }

        // Encuentra al propietario del enlace
        $owner = $link->user; // Relación definida en el modelo Link
        if ($owner) {
            // Verifica si el propietario fue referido por otro usuario
            if ($owner->referrer_id) {
                // Encuentra al usuario principal (el "padre")
                $referrer = User::findOne($owner->referrer_id);
                if ($referrer) {
                    // Incrementa el balance del usuario principal
                    $referrer->balance += 0.0005;
                    $referrer->save(false); // Guarda sin validaciones
                }
            }
        }

        // Opcional: Guarda el clic en la tabla de estadísticas
        $this->registerClick($linkId);

        return $this->asJson(['success' => true, 'message' => 'Clic registrado correctamente.']);
    }
}
