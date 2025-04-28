<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\News $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="news-form card shadow-sm p-3">
    <h2><i class="fas fa-edit text-primary"></i> <?= $model->isNewRecord ? 'Crear Noticia' : 'Actualizar Noticia' ?></h2>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true, 'placeholder' => 'Título de la Noticia'])->label('<i class="fas fa-heading"></i> Título') ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6, 'placeholder' => 'Contenido de la noticia'])->label('<i class="fas fa-align-left"></i> Contenido') ?>

    <div class="form-group">
        <?= Html::submitButton('<i class="fas fa-save"></i> Guardar', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>