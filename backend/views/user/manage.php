<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $users common\models\User[] */
/** @var $roles yii\rbac\Role[] */

$this->title = 'Gestión de Usuarios y Roles';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

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
                        <?= Html::dropDownList(
                            'roleName',
                            Yii::$app->authManager->getRolesByUser($user->id) ? array_keys(Yii::$app->authManager->getRolesByUser($user->id))[0] : null,
                            array_map(fn($role) => $role->name, $roles),
                            ['class' => 'form-control']
                        )
                        

                        ?>
                        <?= Html::submitButton('Cambiar Rol', ['class' => 'btn btn-primary btn-sm mt-2']) ?>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>