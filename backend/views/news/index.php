<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Gestión de Noticias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><i class="fas fa-newspaper text-primary"></i> <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('<i class="fas fa-plus-circle"></i> Crear Noticia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'created_at',
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
                        return Html::a('<i class="fas fa-eye"></i>', $url, ['title' => 'Ver']);
                    },
                    'update' => function ($url) {
                        return Html::a('<i class="fas fa-edit"></i>', $url, ['title' => 'Editar']);
                    },
                    'delete' => function ($url) {
                        return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                            'title' => 'Eliminar',
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