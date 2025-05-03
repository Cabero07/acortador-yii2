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
            <div class="d-flex justify-content-between align-items-center mb-3">
                <?= Html::a('<i class="fas fa-plus-circle"></i> Crear Nuevo Enlace', ['create-link'], ['class' => 'btn btn-success']) ?>
                <span class="text-muted"><i class="fas fa-info-circle"></i> Haz clic en los enlaces para redirigir.</span>
            </div>

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => "{items}\n<div class='d-flex justify-content-between align-items-center mt-3'>{summary}{pager}</div>",
                    'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn', 'header' => '#'],
                        [
                            'attribute' => 'url',
                            'label' => '<i class="fas fa-globe"></i> URL Original',
                            'encodeLabel' => false,
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a('<i class="fas fa-external-link-alt"></i> ' . $model->url, $model->url, [
                                    'target' => '_blank',
                                    'class' => 'text-decoration-none',
                                ]);
                            },
                        ],
                        [
                            'attribute' => 'short_code',
                            'label' => '<i class="fas fa-compress-arrows-alt"></i> Enlace Acortado',
                            'encodeLabel' => false,
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a('<i class="fas fa-link"></i> ' . Yii::$app->request->hostInfo . '/' . $model->short_code, Yii::$app->request->hostInfo . '/' . $model->short_code, [
                                    'target' => '_blank',
                                    'class' => 'text-success text-decoration-none',
                                    'onclick' => "registerClick('{$model->short_code}')",
                                ]);
                            },
                        ],
                        [
                            'attribute' => 'is_active',
                            'label' => '<i class="fas fa-toggle-on"></i> Estado',
                            'encodeLabel' => false,
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->is_active ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>';
                            },
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'label' => '<i class="fas fa-mouse-pointer"></i> Clics',
                            'encodeLabel' => false,
                            'value' => function ($model) {
                                return $model->stats->clicks ?? 0;
                            },
                            'contentOptions' => ['class' => 'text-center fw-bold'],
                        ],
                        [
                            'attribute' => 'created_at',
                            'label' => '<i class="fas fa-calendar-alt"></i> Fecha de Creación',
                            'encodeLabel' => false,
                            'format' => 'datetime',
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '<i class="fas fa-cogs"></i> Acciones',
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

<?php
// Registrar el archivo JavaScript para manejar clics en los enlaces
$this->registerJsFile('@web/js/registerClick.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>