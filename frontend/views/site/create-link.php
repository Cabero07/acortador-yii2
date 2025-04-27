<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Crear Enlace Acortado';
$this->params['breadcrumbs'][] = ['label' => 'Listado de Enlaces', 'url' => ['site/links']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-create-link">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Ingrese una URL larga para generar un enlace acortado:</p>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true, 'placeholder' => 'https://example.com'])->label('URL Larga') ?>

    <?= $form->field($model, 'short_code')->textInput(['maxlength' => true, 'placeholder' => 'Ejemplo: mycode123'])->label('Código Corto (Opcional)') ?>

    <div class="form-group">
        <?= Html::submitButton('Crear Enlace', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>