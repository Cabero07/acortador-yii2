<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
/** @var backend\models\NewsSearch $searchModel */

$this->title = 'Gestión de Noticias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><i class="fas fa-newspaper text-primary"></i> <?= Html::encode($this->title) ?></h1>

    <div class="card shadow-sm bg-light p-3 mb-4">
        <h5><i class="fas fa-search text-success"></i> Filtros de Búsqueda</h5>
        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['index'],
        ]); ?>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($searchModel, 'title')->textInput(['placeholder' => 'Buscar por título'])->label('<i class="fas fa-heading"></i> Título') ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($searchModel, 'created_by')->textInput(['placeholder' => 'Buscar por autor'])->label('<i class="fas fa-user"></i> Autor') ?>
            </div>
            <div class="col-md-4">
                <?= Html::submitButton('<i class="fas fa-search"></i> Buscar', ['class' => 'btn btn-primary mt-4']) ?>
                <?= Html::a('<i class="fas fa-undo"></i> Reiniciar', ['index'], ['class' => 'btn btn-secondary mt-4']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

    <p>
        <?= Html::a('<i class="fas fa-plus-circle"></i> Crear Noticia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'created_at:datetime',
            [
                'attribute' => 'created_by',
                'value' => 'author.username',
                'label' => 'Autor',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Acciones',
                'buttons' => [
                    'view' => function ($url) {
                        return Html::a('<i class="fas fa-eye"></i>', $url, [
                            'title' => 'Ver',
                            'class' => 'btn btn-sm btn-outline-primary',
                        ]);
                    },
                    'update' => function ($url) {
                        return Html::a('<i class="fas fa-edit"></i>', $url, [
                            'title' => 'Editar',
                            'class' => 'btn btn-sm btn-outline-warning',
                        ]);
                    },
                    'delete' => function ($url) {
                        return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                            'title' => 'Eliminar',
                            'class' => 'btn btn-sm btn-outline-danger',
                            'data' => [
                                'confirm' => '¿Estás seguro de que deseas eliminar esta noticia?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>