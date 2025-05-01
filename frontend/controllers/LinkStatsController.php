<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use common\models\LinkStats;
use common\models\Link;
use common\models\User;

/**
 * LinkStatsController maneja las vistas en los enlaces y actualiza el saldo del usuario.
 */
class LinkStatsController extends Controller
{
    /**
     * Registra un clic en un enlace y actualiza el balance del usuario.
     *
     * @param int $linkId ID del enlace
     * @return \yii\web\Response
     * @throws NotFoundHttpException Si el enlace no existe
     */
    public function actionRegisterClick($linkId)
    {
        $transaction = Yii::$app->db->beginTransaction();
        try {
            // Buscar el enlace
            $link = Link::findOne($linkId);
            if (!$link) {
                throw new NotFoundHttpException('El enlace solicitado no existe.');
            }

            // Crear un nuevo registro en LinkStats
            $linkStat = new LinkStats();
            $linkStat->link_id = $linkId;
            $linkStat->clicks = 1; // Cada registro cuenta como un clic
            if (!$linkStat->save()) {
                throw new \Exception('Error al guardar las estadísticas del enlace.');
            }

            // Actualizar el balance del usuario propietario del enlace
            $user = User::findOne($link->user_id);
            if ($user) {
                $incrementAmount = 0.0042; // Incremento por clic
                $user->balance += $incrementAmount;
                if (!$user->save(false)) {
                    throw new \Exception('Error al actualizar el balance del usuario.');
                }
            }

            $transaction->commit();
            return $this->asJson(['status' => 'success', 'message' => 'Clic registrado correctamente.']);
        } catch (\Exception $e) {
            $transaction->rollBack();
            return $this->asJson(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}