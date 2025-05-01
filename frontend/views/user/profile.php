<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Mi Perfil';
?>

<div class="user-profile mt-5">
    <h1 class="text-center text-primary"><i class="fas fa-user-circle"></i> <?= Html::encode($this->title) ?></h1>
    <p class="text-center text-secondary">Gestiona la información de tu cuenta</p>

    <div class="row justify-content-center">
        <!-- Información General del Usuario -->
        <div class="col-lg-6">
            <div class="card shadow-lg mb-4">
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

        <!-- Formulario para Actualizar Información -->
        <div class="col-lg-6">
            <div class="card shadow-lg mb-4">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-edit text-warning"></i> Actualizar Información</h5>
                    <?php $form = ActiveForm::begin(['id' => 'form-update-profile']); ?>

                    <!-- Campo para actualizar correo electrónico -->
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                        <?= $form->field($model, 'email', [
                            'template' => "{input}\n{error}",
                        ])->textInput(['id' => 'email', 'class' => 'form-control', 'placeholder' => 'usuario@correo.com']) ?>
                    </div>

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

    <!-- Sección de Referidos -->
    <div class="row">
        <div class="col-lg-12">
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