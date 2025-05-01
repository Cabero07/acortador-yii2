<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Link;
use common\models\LinkStats;
use yii\web\NotFoundHttpException;

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
}