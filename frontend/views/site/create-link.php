<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Crear Enlace Acortado';
$this->params['breadcrumbs'][] = ['label' => 'Listado de Enlaces', 'url' => ['site/links']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-create-link">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">
                            <i class="fas fa-link"></i> <?= Html::encode($this->title) ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">
                            Ingrese la URL larga que desea acortar y, opcionalmente, un código personalizado para su enlace.
                        </p>

                        <?php $form = ActiveForm::begin([
                            'options' => ['class' => 'needs-validation'],
                        ]); ?>

                        <div class="mb-3">
                            <?= $form->field($model, 'url', [
                                'inputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'https://example.com',
                                ],
                            ])->label('<i class="fas fa-globe"></i> URL Larga') ?>
                        </div>

                        <div class="mb-3">
                            <?= $form->field($model, 'short_code', [
                                'inputOptions' => [
                                    'class' => 'form-control',
                                    'placeholder' => 'Ejemplo: mycode123 (opcional)',
                                ],
                            ])->label('<i class="fas fa-code"></i> Código Corto (Opcional)') ?>
                        </div>

                        <div class="d-grid gap-2">
                            <?= Html::submitButton('<i class="fas fa-plus-circle"></i> Crear Enlace', ['class' => 'btn btn-success btn-lg']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>