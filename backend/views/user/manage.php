<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

/** @var $users common\models\User[] */
/** @var $roles yii\rbac\Role[] */
/** @var $search string */
/** @var $filterStatus int|null */
/** @var $filterRole string|null */

$this->title = 'Gestión de Usuarios y Roles';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-manage">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title"><i class="fas fa-users-cog"></i> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">
            <!-- Formulario de Búsqueda y Filtros -->
            <div class="filter-form mb-4">
                <?php $form = ActiveForm::begin(['method' => 'get', 'action' => ['manage']]); ?>
                <div class="row">
                    <div class="col-md-4">
                        <?= Html::textInput('search', $search, [
                            'class' => 'form-control',
                            'placeholder' => 'Buscar por nombre o correo...',
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= Html::dropDownList('status', $filterStatus, [
                            '' => 'Todos los estados',
                            '10' => 'Habilitado',
                            '-1' => 'Deshabilitado',
                        ], ['class' => 'form-control']) ?>
                    </div>
                    <div class="col-md-3">
                        <?= Html::dropDownList('role', $filterRole, array_merge(['' => 'Todos los roles'], array_map(fn($role) => $role->name, $roles)), [
                            'class' => 'form-control',
                        ]) ?>
                    </div>
                    <div class="col-md-2">
                        <?= Html::submitButton('<i class="fas fa-filter"></i> Filtrar', ['class' => 'btn btn-primary btn-block']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>

            <!-- Tabla de Usuarios -->
            <table class="table table-hover table-striped">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th><i class="fas fa-hashtag"></i> ID</th>
                        <th><i class="fas fa-user"></i> Nombre de Usuario</th>
                        <th><i class="fas fa-envelope"></i> Correo Electrónico</th>
                        <th><i class="fas fa-toggle-on"></i> Estado</th>
                        <th><i class="fas fa-user-tag"></i> Rol</th>
                        <th><i class="fas fa-tools"></i> Acciones</th>
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
                                <?= Html::encode($user->role) ?>
                            </td>
                            <td>
                                <!-- Acción para cambiar el estado -->
                                <?php if ($user->status): ?>
                                    <?= Html::a('<i class="fas fa-ban"></i> Deshabilitar', Url::to(['toggle-status', 'id' => $user->id, 'status' => 0]), [
                                        'class' => 'btn btn-warning btn-sm',
                                        'data-confirm' => '¿Estás seguro de deshabilitar este usuario?',
                                    ]) ?>
                                <?php else: ?>
                                    <?= Html::a('<i class="fas fa-check"></i> Habilitar', Url::to(['toggle-status', 'id' => $user->id, 'status' => 10]), [
                                        'class' => 'btn btn-success btn-sm',
                                        'data-confirm' => '¿Estás seguro de habilitar este usuario?',
                                    ]) ?>
                                <?php endif; ?>

                                <!-- Acción para cambiar el rol -->
                                <?php if ($user->role === 'user'): ?>
                                    <?= Html::a('<i class="fas fa-user-shield"></i> Cambiar rol', Url::to(['change-role', 'id' => $user->id, 'roleName' => 'admin']), [
                                        'class' => 'btn btn-info btn-sm',
                                        'data-confirm' => '¿Estás seguro de asignar el rol de Admin a este usuario?',
                                    ]) ?>
                                <?php elseif ($user->role === 'admin'): ?>
                                    <?= Html::a('<i class="fas fa-user"></i> Cambiar rol', Url::to(['change-role', 'id' => $user->id, 'roleName' => 'user']), [
                                        'class' => 'btn btn-secondary btn-sm',
                                        'data-confirm' => '¿Estás seguro de asignar el rol de User a este usuario?',
                                    ]) ?>
                                <?php endif; ?>

                                <!-- Botón para eliminar cuenta -->
                                <?= Html::a('<i class="fas fa-trash-alt"></i> Eliminar', Url::to(['delete-account', 'id' => $user->id]), [
                                    'class' => 'btn btn-danger btn-sm',
                                    'data-confirm' => '¿Estás seguro de que deseas eliminar esta cuenta? Esta acción no se puede deshacer.',
                                    'data-method' => 'post', // Asegura que la solicitud sea POST para mayor seguridad
                                ]) ?>

                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>