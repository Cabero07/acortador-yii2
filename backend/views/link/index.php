<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Manage Links';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-index">

    <h1><?= Html::encode($this->title) ?></h1>

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
                'class' => 'yii\grid\ActionColumn',
                'template' => '{activate} {deactivate}',
                'buttons' => [
                    'activate' => function ($url, $model) {
                        return $model->is_active ? '' : Html::a('Activate', ['activate', 'id' => $model->id]);
                    },
                    'deactivate' => function ($url, $model) {
                        return $model->is_active ? Html::a('Deactivate', ['deactivate', 'id' => $model->id]) : '';
                    },
                ],
            ],
        ],
    ]); ?>

</div>