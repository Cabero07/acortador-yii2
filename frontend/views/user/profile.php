<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'Mi Perfil';
?>
<div class="user-profile mt-5">
    <h1 class="text-center text-primary"><i class="fas fa-user-circle"></i> <?= Html::encode($this->title) ?></h1>
    <p class="text-center text-secondary">Gestiona la información de tu cuenta</p>


    <!-- Información General del Usuario -->
    <div class="user-info mt-5"></div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg mb-2">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-info-circle text-info"></i> Información del Usuario</h5>
                    <p><strong>Nombre de Usuario:</strong> <?= Html::encode(Yii::$app->user->identity->username) ?></p>
                    <p><strong>Correo Electrónico:</strong> <?= Html::encode(Yii::$app->user->identity->email) ?></p>
                    <p><strong>Balance Acumulado:</strong> $<?= Html::encode(number_format(Yii::$app->user->identity->balance, 4)) ?></p>
                    <p><strong>Total de Clics:</strong> <?= Html::encode(Yii::$app->user->identity->totalClicks) ?></p>
                    <?php if (Yii::$app->user->identity->referrer): ?>
                        <p><strong>Referido por:</strong> <?= Html::encode(Yii::$app->user->identity->referrer->username) ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Formulario para Actualizar Información -->
    <div class="update-info mt-5"></div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg mb-2">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-edit text-warning"></i> Actualizar Información</h5>
                    <?php $form = ActiveForm::begin(['id' => 'form-update-profile']); ?>
                    <!-- Campo para actualizar número de teléfono -->
                    <div class="mb-3">
                        <label for="phone_number" class="form-label"><i class="fas fa-phone"></i> Número de Teléfono</label>
                        <?= $form->field($model, 'phone_number', [
                            'template' => "{input}\n{error}",
                        ])->textInput(['id' => 'phone_number', 'class' => 'form-control', 'placeholder' => '+123456789']) ?>
                    </div>

                    <div class="text-center">
                        <?= Html::submitButton('<i class="fas fa-save"></i> Guardar Cambios', ['class' => 'btn btn-success w-100']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
    <div class="change-password mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg mb-2">
                    <div class="card-body">
                        <h2 class="text-center text-danger"><i class="fas fa-key"></i>Actualiza la contraseña</h2>


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
</div>

<!-- Sección de Referidos -->
<div class="user-referrer mt-5"></div>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-lg mb-4">
                <div class="card-body">
                <h5 class="card-title"><i class="fas fa-users text-primary"></i> Usuarios Referidos</h5>
                <?php if (Yii::$app->user->identity->referrals): ?>
                    <ul class="list-group">
                        <?php foreach (Yii::$app->user->identity->referrals as $referral): ?>
                            <li class="list-group-item">
                                <strong><?= Html::encode($referral->username) ?></strong>
                                <span class="text-muted">(<?= Html::encode($referral->email) ?>)</span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p class="text-muted">Aún no has referido a ningún usuario.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>