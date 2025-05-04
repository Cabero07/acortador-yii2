<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Solicitar Retiro';
?>
<div class="withdraw-create">
    <div class="container">
        <h1 class="mb-4 text-center"><i class="fas fa-hand-holding-usd"></i> <?= Html::encode($this->title) ?></h1>
        <p class="text-muted text-center">
            Ingresa los detalles para proceder con tu solicitud de retiro. Recuerda que el monto mínimo es de <strong>$10.00</strong>.
        </p>

        <div class="card shadow-sm">
            <div class="card-body">
                <?php $form = ActiveForm::begin(); ?>

                <div class="form-group">
                    <?= $form->field($model, 'amount')->textInput([
                        'type' => 'number',
                        'step' => '0.01',
                        'min' => '10',
                        'class' => 'form-control',
                    ])->label('<i class="fas fa-dollar-sign"></i> Monto a Retirar') ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'payment_method')->dropDownList([
                        'CUP' => 'CUP',
                        'MLC' => 'MLC',
                        'QVAPAY' => 'QVAPAY',
                    ], [
                        'prompt' => 'Selecciona un método de pago',
                        'class' => 'form-control',
                    ])->label('<i class="fas fa-money-check-alt"></i> Método de Pago') ?>
                </div>

                <div class="form-group">
                    <?= $form->field($model, 'details')->textInput([
                        'class' => 'form-control',
                        'placeholder' => '1234-5678-9012-3456 (Número de tarjeta) o tu correo electrónico',
                    ])->label('<i class="fas fa-info-circle"></i> Detalles del Pago') ?>
                </div>

                <div class="form-group text-center">
                    <?= Html::submitButton('<i class="fas fa-paper-plane"></i> Enviar Solicitud', [
                        'class' => 'btn btn-primary btn-lg',
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>

<?php
$script = <<<JS
    $('#withdrawrequest-payment_method').change(function () {
        let method = $(this).val();
        let detailsInput = $('#withdrawrequest-details');

        if (method === 'CUP' || method === 'MLC') {
            detailsInput.attr('placeholder', '1234-5678-9012-3456 (Número de tarjeta)');
            detailsInput.on('input', function () {
                this.value = this.value.replace(/[^0-9]/g, '').replace(/(.{4})/g, '$1-').replace(/-$/, '');
            });
        } else if (method === 'QVAPAY') {
            detailsInput.attr('placeholder', 'Correo electrónico');
            detailsInput.off('input').on('input', function () {
                // No formatear para QVAPAY, pero validar correo
                let emailRegex = /^[^@\\s]+@[^@\\s]+\\.[^@\\s]+$/;
                if (!emailRegex.test(this.value)) {
                    $(this).addClass('is-invalid');
                } else {
                    $(this).removeClass('is-invalid');
                }
            });
        } else {
            detailsInput.attr('placeholder', 'Detalles del Pago');
            detailsInput.off('input');
        }
    });
JS;
$this->registerJs($script);
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
?>