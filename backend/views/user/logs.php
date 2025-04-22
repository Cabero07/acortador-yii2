<?php

use yii\helpers\Html;

/** @var $logs common\models\UserLog[] */

$this->title = 'Historial de Cambios';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario Afectado</th>
            <th>Acción</th>
            <th>Realizado por</th>
            <th>Fecha</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($logs as $log): ?>
            <tr>
                <td><?= $log->id ?></td>
                <td><?= Html::encode($log->user->username) ?></td>
                <td><?= Html::encode($log->action) ?></td>
                <td><?= Html::encode($log->performedBy->username) ?></td>
                <td><?= $log->created_at ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>