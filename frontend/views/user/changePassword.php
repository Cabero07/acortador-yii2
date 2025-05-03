<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Cambiar Contraseña';
?>
<div class="change-password mt-5">
    <h1 class="text-center text-danger"><i class="fas fa-key"></i> <?= Html::encode($this->title) ?></h1>
    <p class="text-center text-secondary">Actualiza la contraseña de tu cuenta</p>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg mb-4">
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'form-change-password']); ?>

                    <!-- Campo para contraseña actual -->
                    <div class="mb-3">
                        <label for="current_password" class="form-label"><i class="fas fa-lock"></i> Contraseña Actual</label>
                        <?= $form->field($passwordModel, 'current_password', [
                            'template' => "{input}\n{error}",
                        ])->passwordInput(['id' => 'current_password', 'class' => 'form-control', 'placeholder' => 'Contraseña actual']) ?>
                    </div>

                    <!-- Campo para nueva contraseña -->
                    <div class="mb-3">
                        <label for="new_password" class="form-label"><i class="fas fa-lock"></i> Nueva Contraseña</label>
                        <?= $form->field($passwordModel, 'new_password', [
                            'template' => "{input}\n{error}",
                        ])->passwordInput(['id' => 'new_password', 'class' => 'form-control', 'placeholder' => 'Nueva contraseña']) ?>
                    </div>

                    <!-- Campo para confirmar nueva contraseña -->
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label"><i class="fas fa-lock"></i> Confirmar Contraseña</label>
                        <?= $form->field($passwordModel, 'confirm_password', [
                            'template' => "{input}\n{error}",
                        ])->passwordInput(['id' => 'confirm_password', 'class' => 'form-control', 'placeholder' => 'Confirma tu nueva contraseña']) ?>
                    </div>

                    <div class="text-center">
                        <?= Html::submitButton('<i class="fas fa-save"></i> Cambiar Contraseña', ['class' => 'btn btn-danger w-100']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>