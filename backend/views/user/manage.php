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

<h1><?= Html::encode($this->title) ?></h1>

<!-- Formulario de búsqueda y filtros -->
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
            <?= Html::submitButton('Filtrar', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<!-- Tabla de usuarios -->
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre de Usuario</th>
            <th>Correo Electrónico</th>
            <th>Estado</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= Html::encode($user->username) ?></td>
                <td><?= Html::encode($user->email) ?></td>
                <td>
                    <?= $user->status ? 'Habilitado' : 'Deshabilitado' ?>
                    <?= Html::a(
                        $user->status ? 'Deshabilitar' : 'Habilitar',
                        Url::to(['toggle-status', 'id' => $user->id, 'status' => $user->status ? 0 : 1]),
                        [
                            'class' => $user->status ? 'btn btn-warning btn-sm' : 'btn btn-success btn-sm',
                            'data-confirm' => $user->status
                                ? '¿Estás seguro de deshabilitar este usuario?'
                                : '¿Estás seguro de habilitar este usuario?',
                        ]
                    ) ?>
                </td>
                <td>
                    <form method="post" action="<?= Url::to(['change-role', 'id' => $user->id]) ?>">
                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                        <?= Html::dropDownList(
                            'roleName',
                            Yii::$app->authManager->getRolesByUser($user->id) ? array_keys(Yii::$app->authManager->getRolesByUser($user->id))[0] : null,
                            array_map(fn($role) => $role->name, $roles),
                            ['class' => 'form-control']
                        ) ?>
                        <?= Html::submitButton('Cambiar Rol', ['class' => 'btn btn-primary btn-sm mt-2']) ?>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>