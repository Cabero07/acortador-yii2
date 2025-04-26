<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\SettingsForm $model */

$this->title = 'Configuraciones Generales';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="settings-form">
    <div class="card">
        <div class="card-header bg-info text-white">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'linkLimitPerUser')->textInput(['type' => 'number']) ?>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>