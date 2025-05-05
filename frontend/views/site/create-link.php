<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Link $model */
/** @var string|null $favicon */

$this->title = 'Crear Enlace Acortado';
?>

<div class="site-create-link">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">
                            <i class="fas fa-link"></i> <?= Html::encode($this->title) ?>
                        </h3>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">
                            Ingrese la URL larga que desea acortar. Puede proporcionar un código personalizado opcional y previsualizar el ícono del sitio.
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

                        <?php if ($favicon): ?>
                            <div class="mb-3 text-center">
                                <h5>Ícono del Sitio</h5>
                                <img src="<?= Html::encode($favicon) ?>" alt="Ícono del sitio" class="img-thumbnail" style="max-width: 64px;">
                            </div>
                        <?php endif; ?>

                        <div class="d-grid gap-2">
                            <?= Html::submitButton('<i class="fas fa-search"></i> Previsualizar', [
                                'name' => 'preview',
                                'class' => 'btn btn-secondary',
                                'value' => 'preview',
                            ]) ?>
                            <?= Html::submitButton('<i class="fas fa-plus-circle"></i> Crear Enlace', [
                                'class' => 'btn btn-success btn-lg',
                            ]) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>