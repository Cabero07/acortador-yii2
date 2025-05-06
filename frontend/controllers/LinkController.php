<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Link;
use common\models\LinkStats;
use yii\web\NotFoundHttpException;
use common\models\User;
use common\models\UserLog;

class LinkController extends Controller
{
    /**
     * Acción para redirigir a la página intermedia antes de la URL original.
     */
    public function actionRedirect($shortCode)
    {
        $link = Link::findOne(['short_code' => $shortCode]);

        if (!$link || !$link->is_active) {
            throw new NotFoundHttpException('El enlace no existe o está inactivo.');
        }

        // Redirigir a la página intermedia.
        return $this->redirect(['link/intermediate', 'shortCode' => $shortCode]);
    }

    /**
     * Acción para mostrar la página intermedia con anuncios y un contador.
     */
    public function actionIntermediate($shortCode)
    {
        $link = Link::findOne(['short_code' => $shortCode]);

        if (!$link) {
            throw new NotFoundHttpException('El enlace no existe.');
        }

        return $this->render('intermediate', [
            'link' => $link,
        ]);
    }

    /**
     * Acción para completar la redirección y registrar clics y ganancias.
     */
    public function actionCompleteRedirect($shortCode)
    {
        $link = Link::findOne(['short_code' => $shortCode]);

        if (!$link || !$link->is_active) {
            throw new NotFoundHttpException('El enlace no existe o está inactivo.');
        }

        // Verificar si el conteo de clics está habilitado
        if (Yii::$app->settings->get('click_tracking_enabled', true)) {
            $stats = LinkStats::findOne(['link_id' => $link->id]) ?? new LinkStats(['link_id' => $link->id]);
            $stats->clicks += 1;

            if ($stats->save()) {
                $this->registerEarnings($link);
            }
        }

        return $this->redirect($link->url);
    }
    
    /**
     * Método para registrar ganancias para el propietario del enlace y su referidor.
     */
    private function registerEarnings(Link $link)
    {
        $user = $link->user;

        // Ganancia directa para el propietario del enlace.
        if ($user) {
            $this->addEarnings($user, 0.004, $user->id);

            // Ganancia indirecta para el referidor, si existe.
            if ($user->referrer_id) {
                $referrer = User::findOne($user->referrer_id);
                if ($referrer) {
                    $this->addEarnings($referrer, 0.002, $user->id);
                }
            }
        }
    }

    /**
     * Método para agregar ganancias a un usuario y registrar el log.
     */
    private function addEarnings(User $user, float $amount, int $performedBy)
    {
        // Incrementar balance del usuario.
        $user->balance += $amount;
        $user->save(false);

        // Registrar el log de la transacción.
        $log = new UserLog([
            'user_id' => $user->id,
            'amount' => $amount,
            'action' => 'Recibir',
            'performed_by' => $performedBy,
            'balance_after' => $user->balance,
        ]);
        $log->save(false);
    }
}
