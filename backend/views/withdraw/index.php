<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Gestión de Retiros';
?>
<div class="withdraw-management">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'user_id',
                'label' => 'Usuario',
                'value' => function ($model) {
                    return $model->user->username; // Mostrar el nombre del usuario
                },
            ],
            'amount',
            'payment_method',
            [
                'attribute' => 'details',
                'label' => 'Detalles del Pago',
            ],
            [
                'attribute' => 'status',
                'label' => 'Estado',
                'value' => function ($model) {
                    switch ($model->status) {
                        case 'pendiente':
                            return 'Pendiente';
                        case 'aprobado':
                            return 'Aprobado';
                        case 'completado':
                            return 'Completado';
                        default:
                            return 'Desconocido';
                    }
                },
            ],
            'created_at:datetime',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{approve} {complete}',
                'buttons' => [
                    'approve' => function ($url, $model) {
                        if ($model->status === 'pendiente') {
                            return Html::a('Aprobar', ['update-status', 'id' => $model->id, 'status' => 'aprobado'], ['class' => 'btn btn-success btn-sm']);
                        }
                    },
                    'complete' => function ($url, $model) {
                        if ($model->status === 'aprobado') {
                            return Html::a('Completar', ['update-status', 'id' => $model->id, 'status' => 'completado'], ['class' => 'btn btn-primary btn-sm']);
                        }
                    },
                ],
            ],
        ],
    ]) ?>
</div>