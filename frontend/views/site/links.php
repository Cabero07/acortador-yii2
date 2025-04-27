<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Mis Enlaces';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="site-links">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="display-6"><?= Html::encode($this->title) ?></h1>
        <?= Html::a('Crear Nuevo Enlace', ['create-link'], ['class' => 'btn btn-primary']) ?>
    </div>

    <div class="table-responsive">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => "{items}\n<div class='d-flex justify-content-between align-items-center mt-3'>{summary}{pager}</div>",
            'tableOptions' => ['class' => 'table table-striped table-hover table-bordered'],
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
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url, $model) {
                            return Html::a('<i class="bi bi-eye"></i>', $url, [
                                'title' => 'Ver',
                                'class' => 'btn btn-sm btn-outline-info',
                            ]);
                        },
                        'update' => function ($url, $model) {
                            return Html::a('<i class="bi bi-pencil"></i>', $url, [
                                'title' => 'Editar',
                                'class' => 'btn btn-sm btn-outline-primary',
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<i class="bi bi-trash"></i>', $url, [
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