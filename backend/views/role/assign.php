<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = "Asignar Rol a: {$user->username}";
$this->params['breadcrumbs'][] = ['label' => 'Gestión de Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="role-assign">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="form">
        <?php $form = ActiveForm::begin(); ?>

        <div class="form-group">
            <label for="role">Selecciona un Rol</label>
            <select id="role" name="role" class="form-control">
                <?php foreach ($roles as $role): ?>
                    <option value="<?= $role->name ?>"><?= $role->description ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Asignar', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>