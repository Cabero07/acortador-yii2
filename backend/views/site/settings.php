<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SettingsForm $model */

$this->title = 'Configuraciones Generales';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="settings-form">
    <div class="card shadow-sm">
        <div class="card-header bg-info text-white">
            <h3 class="card-title"><i class="fas fa-cogs"></i> <?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body bg-light">
            <?php $form = ActiveForm::begin(); ?>

            <div class="form-group">
                <?= $form->field($model, 'linkLimitPerUser')->textInput([
                    'type' => 'number',
                    'class' => 'form-control',
                    'placeholder' => 'Límite de enlaces por usuario',
                ])->label('<i class="fas fa-link"></i> Límite de Enlaces por Usuario') ?>
            </div>

            <div class="form-group text-end">
                <?= Html::submitButton('<i class="fas fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>