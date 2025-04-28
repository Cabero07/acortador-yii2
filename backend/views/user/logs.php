<?php

use yii\helpers\Html;

/** @var $logs common\models\UserLog[] */

$this->title = 'Historial de Cambios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-logs">
    <h1><i class="fas fa-history"></i> <?= Html::encode($this->title) ?></h1>

    <table class="table table-bordered table-hover">
        <thead class="table-primary">
            <tr>
                <th><i class="fas fa-hashtag"></i> ID</th>
                <th><i class="fas fa-user"></i> Usuario Afectado</th>
                <th><i class="fas fa-tasks"></i> Acción</th>
                <th><i class="fas fa-user-shield"></i> Realizado por</th>
                <th><i class="fas fa-calendar-alt"></i> Fecha</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $log): ?>
                <tr>
                    <td><?= $log->id ?></td>
                    <td><?= Html::encode($log->user->username) ?></td>
                    <td><?= Html::encode($log->action) ?></td>
                    <td><?= Html::encode($log->performedBy->username) ?></td>
                    <td><?= Yii::$app->formatter->asDatetime($log->created_at) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>