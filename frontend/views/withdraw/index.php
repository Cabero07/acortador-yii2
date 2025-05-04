<?php

use yii\grid\GridView;
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
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'options' => ['class' => 'table-responsive'],
                    'tableOptions' => ['class' => 'table table-striped table-hover'],
                    'columns' => [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => '#',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'attribute' => 'amount',
                            'label' => 'Monto',
                            'value' => function ($model) {
                                return '$' . number_format($model->amount, 2);
                            },
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center text-success font-weight-bold'],
                        ],
                        [
                            'attribute' => 'payment_method',
                            'label' => 'Método de Pago',
                            'value' => function ($model) {
                                $icons = [
                                    'CUP' => '<i class="fas fa-credit-card"></i> CUP',
                                    'MLC' => '<i class="fas fa-credit-card"></i> MLC',
                                    'QVAPAY' => '<i class="fas fa-envelope"></i> QVAPAY',
                                ];
                                return $icons[$model->payment_method] ?? $model->payment_method;
                            },
                            'format' => 'html',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'attribute' => 'status',
                            'label' => 'Estado',
                            'value' => function ($model) {
                                $statusLabels = [
                                    'pendiente' => '<span class="badge badge-warning"><i class="fas fa-hourglass-half"></i> Pendiente</span>',
                                    'aprobado' => '<span class="badge badge-info"><i class="fas fa-check-circle"></i> Aprobado</span>',
                                    'completado' => '<span class="badge badge-success"><i class="fas fa-check"></i> Completado</span>',
                                    'rechazado' => '<span class="badge badge-danger"><i class="fas fa-times-circle"></i> Rechazado</span>',
                                ];
                                return $statusLabels[$model->status] ?? $model->status;
                            },
                            'format' => 'html',
                            'headerOptions' => ['class' => 'text-center'],
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>

<?php
// Carga de Font Awesome para los íconos
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
?>