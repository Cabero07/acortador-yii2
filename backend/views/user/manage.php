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
        <div class="card-body bg-light">
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
                        <th><i class="fas fa-dollar-sign"></i> Ganancia Total</th>
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
                            <td class="text-center fw-bold">
                                $<?= number_format($user->balance, 4) ?>
                            </td>
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
                                <?= Html::a('<i class="fas fa-edit"></i>', ['update', 'id' => $user->id], ['class' => 'btn btn-sm btn-warning']) ?>
                                <?= Html::a('<i class="fas fa-trash"></i>', ['delete', 'id' => $user->id], [
                                    'class' => 'btn btn-sm btn-danger',
                                    'data-confirm' => '¿Estás seguro de eliminar este usuario?',
                                    'data-method' => 'post',
                                ]) ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>