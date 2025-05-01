<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Gestión de Enlaces';


?>
<div class="site-links">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title"><i class="fas fa-link"></i> <?= Html::encode($this->title) ?></h1>
            <p class="card-text">Gestiona todos tus enlaces acortados desde aquí.</p>
        </div>
        <div class="card-body bg-light">
            <?= Html::a('<i class="fas fa-plus-circle"></i> Crear Nuevo Enlace', ['create-link'], ['class' => 'btn btn-success mb-3']) ?>

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => "{items}\n<div class='d-flex justify-content-between align-items-center mt-3'>{summary}{pager}</div>",
                    'tableOptions' => ['class' => 'table table-bordered table-hover'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn', 'header' => '#'],
                        [
                            'attribute' => 'url',
                            'label' => 'URL Original',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a($model->url, $model->url, ['target' => '_blank', 'class' => 'text-decoration-none']);
                            },
                        ],
                        [
                            'attribute' => 'short_code',
                            'label' => 'Enlace Acortado',
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a(Yii::$app->request->hostInfo . '/' . $model->short_code, Yii::$app->request->hostInfo . '/' . $model->short_code, [
                                    'target' => '_blank',
                                    'class' => 'text-success text-decoration-none',
                                ]);
                            },
                        ],
                        [
                            'label' => 'Clics',
                            'value' => function ($model) {
                                return $model->stats->clicks ?? 0;
                            },
                            'contentOptions' => ['class' => 'text-center fw-bold'],
                        ],
                        'created_at:datetime',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Acciones',
                            'template' => '{delete}',
                            'buttons' => [
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                                        'title' => 'Eliminar',
                                        'class' => 'btn btn-sm btn-outline-danger',
                                        'data-confirm' => '¿Estás seguro de eliminar este enlace?',
                                        'data-method' => 'post',
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>