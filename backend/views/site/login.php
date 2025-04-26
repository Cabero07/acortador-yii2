<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \common\models\LoginForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Admin Login';
?>
<div class="d-flex justify-content-center align-items-center vh-100 bg-light text-dark">
    <div class="card border shadow-lg" style="width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4"><?= Html::encode($this->title) ?></h2>
            <p class="text-center text-muted">Acceso solo a administradores:</p>
            
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
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>