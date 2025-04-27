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
            $stats->earnings += 0.05; // Ejemplo: Ganancia fija por clic
            $stats->save();

            return $this->redirect($link->url);
        }

        throw new NotFoundHttpException('El enlace no existe.');
    }
}