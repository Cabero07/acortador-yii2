<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Retirar Balance';
?>

<div class="withdrawn-container mt-5">
    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>
    <p class="text-muted text-center">Puedes retirar un monto de tu balance si tienes al menos $10 disponibles.</p>

    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="text-center">Tu balance actual: <span class="text-success">$<?= number_format($user->balance, 2) ?></span></h4>
            
            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger text-center">
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success text-center">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <?php $form = ActiveForm::begin(); ?>
                <div class="form-group">
                    <?= Html::label('Monto a Retirar', 'amount', ['class' => 'form-label']) ?>
                    <?= Html::input('number', 'amount', null, [
                        'class' => 'form-control',
                        'min' => 10,
                        'max' => $user->balance,
                        'step' => '0.01',
                        'required' => true,
                        'placeholder' => 'Ingresa el monto a retirar',
                    ]) ?>
                </div>
                <div class="text-center">
                    <?= Html::submitButton('<i class="fas fa-money-check-alt"></i> Retirar', ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('<i class="fas fa-arrow-left"></i> Volver', ['activity'], ['class' => 'btn btn-secondary']) ?>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>