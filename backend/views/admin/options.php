<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var backend\models\AdminOptions $model */

$this->title = 'Opciones Administrativas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-options">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="card shadow-sm">
        <div class="card-body">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'ad_display_time')->textInput(['type' => 'number', 'min' => 1])->label('Tiempo de Redirección (segundos)') ?>

            <?= $form->field($model, 'adskeeper_code')->textarea(['rows' => 4])->label('Código de Integración de AdsKeeper') ?>

            <?= $form->field($model, 'click_tracking_enabled')->checkbox()->label('Habilitar Conteo de Clics y Ganancias') ?>

            <div class="form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>