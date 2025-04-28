<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $users common\models\User[] */

$this->title = 'Gestión de Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-management">
    <h1><i class="fas fa-users"></i> <?= Html::encode($this->title) ?></h1>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th><i class="fas fa-user"></i> Nombre de Usuario</th>
                <th><i class="fas fa-envelope"></i> Correo Electrónico</th>
                <th><i class="fas fa-toggle-on"></i> Estado</th>
                <th><i class="fas fa-cog"></i> Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= $user->id ?></td>
                    <td><?= Html::encode($user->username) ?></td>
                    <td><?= Html::encode($user->email) ?></td>
                    <td>
                        <?= $user->status
                            ? '<span class="badge bg-success">Habilitado</span>'
                            : '<span class="badge bg-danger">Deshabilitado</span>' ?>
                    </td>
                    <td>
                        <?php if ($user->status): ?>
                            <?= Html::a('<i class="fas fa-ban"></i> Deshabilitar', Url::to(['toggle-status', 'id' => $user->id, 'status' => 0]), [
                                'class' => 'btn btn-warning btn-sm',
                                'data-confirm' => '¿Estás seguro de deshabilitar este usuario?',
                            ]) ?>
                        <?php else: ?>
                            <?= Html::a('<i class="fas fa-check"></i> Habilitar', Url::to(['toggle-status', 'id' => $user->id, 'status' => 1]), [
                                'class' => 'btn btn-success btn-sm',
                                'data-confirm' => '¿Estás seguro de habilitar este usuario?',
                            ]) ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>