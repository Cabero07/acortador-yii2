<?php

use yii\helpers\Html;

$this->title = 'Mis Retiros';
?>
<div class="withdraw-requests">
    <div class="container">
        <h1 class="mb-4 text-center"><i class="fas fa-wallet"></i> <?= Html::encode($this->title) ?></h1>
        <p class="text-muted text-center">
            Aquí puedes visualizar el estado y detalles de tus retiros realizados.
        </p>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Monto</th>
                                <th class="text-center">Método de Pago</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Fecha de Creación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($dataProvider->models as $index => $model): ?>
                                <tr>
                                    <td class="text-center"><?= $index + 1 ?></td>
                                    <td class="text-center text-success font-weight-bold">
                                        <?= '$' . number_format($model->amount, 2) ?>
                                    </td>
                                    <td class="text-center">
                                        <?php
                                        $icons = [
                                            'CUP' => '<i class="fas fa-credit-card"></i> CUP',
                                            'MLC' => '<i class="fas fa-credit-card"></i> MLC',
                                            'QVAPAY' => '<i class="fas fa-envelope"></i> QVAPAY',
                                        ];
                                        echo $icons[$model->payment_method] ?? $model->payment_method;
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($model->status == 'pendiente'): ?>
                                            <span class="badge badge-warning text-warning"><i class="fas fa-hourglass-half"></i> <?= Html::encode($model->status) ?></span>
                                        <?php elseif ($model->status == 'aprobado'): ?>
                                            <span class="badge badge-info text-info"><i class="fas fa-check-circle"></i> <?= Html::encode($model->status) ?></span>
                                        <?php elseif ($model->status == 'completado'): ?>
                                            <span class="badge badge-success text-success"><i class="fas fa-check"></i> <?= Html::encode($model->status) ?></span>
                                        <?php elseif ($model->status == 'rechazado'): ?>
                                            <span class="badge badge-danger text-danger"><i class="fas fa-times-circle"></i> <?= Html::encode($model->status) ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-center text-muted">
                                        <?= Yii::$app->formatter->asDatetime($model->created_at, 'php:d/m/Y H:i:s') ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Carga de Font Awesome para los íconos
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
?>