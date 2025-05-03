<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\UserLog;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\web\View;

$this->title = 'Actividad de Balance';
?>
<div class="activity-container mt-5">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <p class="text-muted text-center">Historial detallado de ganancias y retiros.</p>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="bg-primary text-white text-center">
                <tr>
                    <th><i class="fas fa-calendar-alt"></i> Fecha</th>
                    <th><i class="fas fa-exchange-alt"></i> Acción</th>
                    <th><i class="fas fa-money-bill-wave"></i> Monto</th>
                    <th><i class="fas fa-wallet"></i> Balance Posterior</th>
                </tr>
            </thead>
            <?php $userId = Yii::$app->user->id; ?>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <?php if ($log->user_id === $userId && in_array($log->action, ['Recibir', 'Retirar'])): ?>
                        <tr>
                            <!-- Fecha -->
                            <td class="text-center">
                                <?= Yii::$app->formatter->asDatetime($log->created_at) ?>
                            </td>

                            <!-- Acción -->
                            <td class="text-center">
                                <?php if ($log->amount > 0): ?>
                                    <span class="text-success">
                                        <i class="fas fa-arrow-up"></i> <?= Html::encode($log->action) ?>
                                    </span>
                                <?php else: ?>
                                    <span class="text-danger">
                                        <i class="fas fa-arrow-down"></i> <?= Html::encode($log->action) ?>
                                    </span>
                                <?php endif; ?>
                            </td>

                            <!-- Monto -->
                            <td class="text-center <?= $log->amount > 0 ? 'text-success' : 'text-danger' ?>">
                                <?= $log->amount > 0 ? '+' : '' ?><?= number_format($log->amount, 4) ?>
                            </td>

                            <!-- Balance Posterior -->
                            <td class="text-center">
                                <?= Yii::$app->formatter->asCurrency($log->balance_after) ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>