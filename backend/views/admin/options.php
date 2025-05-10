<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AdminOptions $model */

$this->title = 'Opciones Administrativas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-options">
    <h1 class="mb-4"><i class="fas fa-cogs"></i> <?= Html::encode($this->title) ?></h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <div class="form-group">
                <label for="ad_display_time"><i class="fas fa-clock"></i> Tiempo de Redirección (segundos)</label>
                <?= $form->field($model, 'ad_display_time', [
                    'template' => '{input}{error}',
                    'options' => ['class' => ''],
                ])->textInput(['type' => 'number', 'min' => 1, 'class' => 'form-control'])->label(false) ?>
            </div>

            <div class="form-group">
                <label for="adskeeper_code"><i class="fas fa-code"></i> Código de Integración del Primer Anuncio</label>
                <?= $form->field($model, 'adskeeper_code', [
                    'template' => '{input}{error}',
                    'options' => ['class' => ''],
                ])->textarea(['rows' => 4, 'class' => 'form-control'])->label(false) ?>
            </div>

            <div class="form-group">
                <label for="ad_code_2"><i class="fas fa-code"></i> Código de Integración del Segundo Anuncio</label>
                <?= $form->field($model, 'ad_code_2', [
                    'template' => '{input}{error}',
                    'options' => ['class' => ''],
                ])->textarea(['rows' => 4, 'class' => 'form-control'])->label(false) ?>
            </div>

            <div class="form-group">
                <label for="ad_code_3"><i class="fas fa-code"></i> Código de Integración del Tercer Anuncio</label>
                <?= $form->field($model, 'ad_code_3', [
                    'template' => '{input}{error}',
                    'options' => ['class' => ''],
                ])->textarea(['rows' => 4, 'class' => 'form-control'])->label(false) ?>
            </div>

            <div class="form-group form-check">
                <?= $form->field($model, 'click_tracking_enabled', [
                    'template' => '<div class="custom-control custom-checkbox">{input}{label}{error}</div>',
                    'options' => ['class' => ''],
                ])->checkbox(['class' => 'custom-control-input', 'id' => 'click_tracking_enabled'], false)->label('<i class="fas fa-eye"></i> Conteo de Clics y Ganancias (CUIDADO NO TOCAR)', ['class' => 'custom-control-label']) ?>
            </div>

            <div class="form-group">
                <label for="own_click_earning"><i class="fas fa-dollar-sign"></i> Ganancia por Clic Propio ($USD)</label>
                <?= $form->field($model, 'own_click_earning', [
                    'template' => '{input}{error}',
                    'options' => ['class' => ''],
                ])->textInput(['type' => 'number', 'step' => '0.0001', 'class' => 'form-control'])->label(false) ?>
            </div>

            <div class="form-group">
                <label for="referral_click_earning"><i class="fas fa-user-friends"></i> Ganancia por Clic de Referido ($USD)</label>
                <?= $form->field($model, 'referral_click_earning', [
                    'template' => '{input}{error}',
                    'options' => ['class' => ''],
                ])->textInput(['type' => 'number', 'step' => '0.0001', 'class' => 'form-control'])->label(false) ?>
            </div>
            <div class="form-group">
                <label for="exchange_rate_cup"><i class="fas fa-exchange-alt"></i> Tasa de Cambio (USD a CUP)</label>
                <?= $form->field($model, 'exchange_rate_cup', [
                    'template' => '{input}{error}',
                    'options' => ['class' => ''],
                ])->textInput(['type' => 'number', 'step' => '0.01', 'class' => 'form-control', 'placeholder' => 'Ejemplo: 24.0'])->label(false) ?>
            </div>

            <div class="form-group">
                <label for="exchange_rate_mlc"><i class="fas fa-exchange-alt"></i> Tasa de Cambio (USD a MLC)</label>
                <?= $form->field($model, 'exchange_rate_mlc', [
                    'template' => '{input}{error}',
                    'options' => ['class' => ''],
                ])->textInput(['type' => 'number', 'step' => '0.01', 'class' => 'form-control', 'placeholder' => 'Ejemplo: 1.0'])->label(false) ?>
            </div>
            <div class="text-right">
                <?= Html::submitButton('<i class="fas fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php
// Cargar Font Awesome para los iconos
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', [
    'integrity' => 'sha384-dyB8A0sH6Lk7m3gA9gQmMVmJvR3hQIx1Lb1CWU4LhV5W1nq1aF1jV8V0N8Vt4C5w',
    'crossorigin' => 'anonymous',
]);
?>