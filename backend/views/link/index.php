<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Manage Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Show Active', ['index', 'filter' => 'active'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Show Inactive', ['index', 'filter' => 'inactive'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'url',
            [
                'attribute' => 'is_active',
                'value' => function ($model) {
                    return $model->is_active ? 'Active' : 'Inactive';
                },
            ],
            [
                'attribute' => 'created_by',
                'value' => function ($model) {
                    return $model->creator ? $model->creator->username : 'Unknown';
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{activate} {deactivate} {delete}',
                'buttons' => [
                    'activate' => function ($url, $model) {
                        return $model->is_active ? '' : Html::a('Activate', ['activate', 'id' => $model->id]);
                    },
                    'deactivate' => function ($url, $model) {
                        return $model->is_active ? Html::a('Deactivate', ['deactivate', 'id' => $model->id]) : '';
                    },
                    'delete' => function ($url, $model) {
                        return Html::a('Delete', ['delete', 'id' => $model->id], [
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this link?',
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>

</div>