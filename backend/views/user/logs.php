<?php

use yii\helpers\Html;

/** @var $logs common\models\UserLog[] */

$this->title = 'Historial de Cambios';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-logs">
    <div class="card">
        <div class="card-header bg-success text-white">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead class="bg-secondary text-white">
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
        </div>
    </div>
</div>