<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;
use common\models\WithdrawRequest;

$this->title = 'Gestión de Retiros';
?>
<div class="withdraw-management">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'tableOptions' => ['class' => 'table table-striped table-hover table-bordered'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'user_id',
                        'label' => 'Usuario',
                        'value' => function ($model) {
                            return $model->user->username; // Relación con el modelo User
                        },
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
                            return $model->payment_method;
                        },
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'label' => 'Monto en la moneda elegida',
                        'value' => function ($model) {
                            $conversionRate = $model->getConversionRate();
                            return number_format($model->amount * $conversionRate, 2) . ' ' . $model->payment_method;
                        },
                        'headerOptions' => ['class' => 'text-center'],
                        'contentOptions' => ['class' => 'text-center text-primary font-weight-bold'],
                    ],
                    [
                        'attribute' => 'details',
                        'label' => 'Detalles del Pago',
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
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{confirm} {complete} {reject}',
                        'buttons' => [
                            'confirm' => function ($url, $model) {
                                if ($model->status === 'pendiente') {
                                    return Html::a('<i class="fas fa-check"></i> Confirmar', ['update-status', 'id' => $model->id, 'status' => 'aprobado'], [
                                        'class' => 'btn btn-sm btn-success',
                                        'title' => 'Confirmar Retiro',
                                    ]);
                                }
                            },
                            'complete' => function ($url, $model) {
                                if ($model->status === 'aprobado') {
                                    return Html::a('<i class="fas fa-check-double"></i> Completar', ['update-status', 'id' => $model->id, 'status' => 'completado'], [
                                        'class' => 'btn btn-sm btn-primary',
                                        'title' => 'Completar Retiro',
                                    ]);
                                }
                            },
                            'reject' => function ($url, $model) {
                                if ($model->status === 'pendiente') {
                                    return Html::a('<i class="fas fa-times"></i> Rechazar', ['reject', 'id' => $model->id], [
                                        'class' => 'btn btn-sm btn-danger',
                                        'title' => 'Rechazar Retiro',
                                        'data-confirm' => '¿Estás seguro de que deseas rechazar este retiro?',
                                    ]);
                                }
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>

<?php
// Carga de Font Awesome para los íconos
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
?>