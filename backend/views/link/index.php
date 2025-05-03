<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Manage Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'short_code',
            'url:url',
            [
                'attribute' => 'is_active',
                'filter' => [1 => 'Active', 0 => 'Inactive'],
                'value' => function ($model) {
                    return $model->is_active ? 'Active' : 'Inactive';
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'user_id',
                'label' => 'Created By',
                'value' => function ($model) {
                    return $model->creator ? Html::encode($model->creator->username) : 'Unknown';
                },
            ],
            'created_at',
            'updated_at',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{activate} {deactivate} {delete}',
                'buttons' => [
                    'activate' => function ($url, $model) {
                        return !$model->is_active ? Html::a('Activate', ['activate', 'id' => $model->id], ['class' => 'btn btn-success btn-sm']) : '';
                    },
                    'deactivate' => function ($url, $model) {
                        return $model->is_active ? Html::a('Deactivate', ['deactivate', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm']) : '';
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Delete', ['delete', 'id' => $model->id], [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => 'Estas seguro que quieres eliminar este link?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>