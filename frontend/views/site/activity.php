<?php
use yii\helpers\Html;

$this->title = 'Actividad de Balance';
?>
<div class="activity-container mt-5">
    <h1><?= Html::encode($this->title) ?></h1>
    <p class="text-muted">Historial de cambios en tu balance.</p>

    <table class="table table-bordered">
        <thead class="bg-primary text-white">
            <tr>
                <th>Fecha</th>
                <th>Descripción</th>
                <th>Monto</th>
                <th>Balance Posterior</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?= Yii::$app->formatter->asDatetime($log->created_at) ?></td>
                    <td><?= Html::encode($log->description) ?></td>
                    <td class="<?= $log->amount > 0 ? 'text-success' : 'text-danger' ?>">
                        <?= $log->amount > 0 ? '+' : '' ?><?= Yii::$app->formatter->asCurrency($log->amount) ?>
                    </td>
                    <td><?= Yii::$app->formatter->asCurrency($log->balance_after) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>