<?php

use yii\helpers\Html;

/** @var $logs common\models\UserLog[] */

$this->title = 'Historial de Cambios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-logs">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title"><i class="fas fa-history"></i> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body bg-light">
            <!-- Formulario de Búsqueda y Filtros -->
            <div class="filter-form mb-4">

                <!-- Tabla de Usuarios -->
                <table class="table table-hover table-striped">
                    <thead class="bg-secondary text-white">
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
        </div>
    </div>
</div>