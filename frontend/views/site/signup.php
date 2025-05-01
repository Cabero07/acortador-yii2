<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Registro';
?>

<div class="site-signup mt-5">
    <h1 class="text-center text-primary my-4"><i class="fas fa-user-plus"></i> <?= Html::encode($this->title) ?></h1>

    <p class="text-center text-secondary">Crea tu cuenta llenando los siguientes campos:</p>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg">
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                    <div class="mb-3">
                        <label for="username" class="form-label"><i class="fas fa-user"></i> Nombre de Usuario</label>
                        <?= $form->field($model, 'username', [
                            'template' => "{input}\n{error}",
                        ])->textInput(['id' => 'username', 'class' => 'form-control', 'autofocus' => true]) ?>
                    </div>

                    <div class="mb-3">
                        <label for="phone_number" class="form-label"><i class="fas fa-phone"></i> Número de Teléfono</label>
                        <?= $form->field($model, 'phone_number', [
                            'template' => "{input}\n{error}",
                        ])->textInput(['id' => 'phone_number', 'class' => 'form-control', 'placeholder' => '+']) ?>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> Contraseña</label>
                        <?= $form->field($model, 'password', [
                            'template' => "{input}\n{error}",
                        ])->passwordInput(['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Mínimo 6 caracteres']) ?>
                    </div>

                    <div class="text-center">
                        <?= Html::submitButton('<i class="fas fa-user-check"></i> Registrarse', ['class' => 'btn btn-primary w-100']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>