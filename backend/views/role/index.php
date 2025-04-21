<?php

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Gestión de Roles';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="role-index">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'username',
            'email',
            [
                'label' => 'Rol Actual',
                'value' => function ($model) {
                    $roles = Yii::$app->authManager->getRolesByUser($model->id);
                    return implode(', ', array_keys($roles));
                },
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{assign}',
                'buttons' => [
                    'assign' => function ($url, $model) {
                        return Html::a('Asignar Rol', ['assign', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    },
                ],
            ],
        ],
    ]) ?>
</div>