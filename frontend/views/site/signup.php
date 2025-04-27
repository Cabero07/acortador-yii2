<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var \frontend\models\SignupForm $model */

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

$this->title = 'Creación de cuenta';
?>
<div class="d-flex justify-content-center align-items-center vh-100 text-dark">
    <div class="card border shadow-lg" style="width: 400px;">
        <div class="card-body">
            <h2 class="card-title text-center mb-4"><?= Html::encode($this->title) ?></h2>
            <p class="text-center text-muted">Crea una cuenta para acceder:</p>
            
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <div class="mb-3">
                    <?= $form->field($model, 'username')->textInput([
                        'autofocus' => true, 
                        'placeholder' => 'Username', 
                        'class' => 'form-control'
                    ])->label(false) ?>
                </div>
                <div class="mb-3">
                    <?= $form->field($model, 'email')->textInput([
                        'placeholder' => 'Email', 
                        'class' => 'form-control'
                    ])->label(false) ?>
                </div>
                <div class="mb-3">
                    <?= $form->field($model, 'password')->passwordInput([
                        'placeholder' => 'Password', 
                        'class' => 'form-control'
                    ])->label(false) ?>
                </div>
                <div class="d-grid">
                    <?= Html::submitButton('Crear cuenta', ['class' => 'btn btn-success btn-block']) ?>
                </div>
                
                <div class="text-center mt-3">
                    <p class="text-muted small">
                        ¿Ya tienes cuenta? <?= Html::a('Entra aquí', ['site/login'], ['class' => 'text-primary']) ?>
                    </p>
                </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>