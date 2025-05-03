<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Acceder';
?>
<div class="d-flex justify-content-center align-items-center vh-100 text-dark">
    <div class="card border shadow-lg" style="width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4">¡Bienvenido! </h2>
            <p class="text-center text-muted">Por favor rellena los campos para acceder:</p>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
            <div class="mb-3">
                <?= $form->field($model, 'username')->textInput([
                    'autofocus' => true,
                    'placeholder' => 'Username',
                    'class' => 'form-control'
                ])->label(false) ?>
            </div>
            <div class="mb-3">
                <?= $form->field($model, 'password')->passwordInput([
                    'placeholder' => 'Password',
                    'class' => 'form-control'
                ])->label(false) ?>
            </div>
            <div class="mb-3 form-check">
                <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'form-check-input']) ?>
            </div>
            <div class="d-grid">
                <?= Html::submitButton('Login', ['class' => 'btn btn-primary btn-block']) ?>
            </div>
            <div class="text-center mt-3">
                <p class="text-muted small">
                <?= Html::a('¿Olvidaste tu contraseña?', ['site/request-password-reset'], ['class' => 'text-primary']) ?>
            </div>
            <div class="text-center mt-3">
                <p class="text-muted small">
                    ¿Si no te has creado la cuenta? <?= Html::a('Entra aquí', ['site/signup'], ['class' => 'text-primary']) ?>
                </p>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>