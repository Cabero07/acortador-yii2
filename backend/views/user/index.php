<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $users common\models\User[] */

$this->title = 'Gestión de Usuarios';
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
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user->id ?></td>
                <td><?= Html::encode($user->username) ?></td>
                <td><?= Html::encode($user->email) ?></td>
                <td><?= $user->status ? 'Habilitado' : 'Deshabilitado' ?></td>
                <td>
                    <?php if ($user->status): ?>
                        <?= Html::a('Deshabilitar', Url::to(['toggle-status', 'id' => $user->id, 'status' => 0]), [
                            'class' => 'btn btn-warning',
                            'data-confirm' => '¿Estás seguro de deshabilitar este usuario?',
                        ]) ?>
                    <?php else: ?>
                        <?= Html::a('Habilitar', Url::to(['toggle-status', 'id' => $user->id, 'status' => 1]), [
                            'class' => 'btn btn-success',
                            'data-confirm' => '¿Estás seguro de habilitar este usuario?',
                        ]) ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>