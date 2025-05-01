<?php
/** @var yii\web\View $this */
use yii\helpers\Html;

$this->title = 'Soporte';
?>
<div class="support-container" style="margin-top: 50px;">
    <div class="text-center my-5">
        <h1 class="display-4 text-primary">¿Necesitas ayuda?</h1>
        <p class="lead text-secondary">Estamos aquí para ayudarte. A continuación, encontrarás las formas en las que puedes contactar a nuestro equipo de soporte.</p>
    </div>
    <div class="row justify-content-center">
        <!-- Telegram Contact -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fab fa-telegram fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Telegram</h5>
                    <p class="card-text">Contáctanos a través de Telegram para una atención más rápida.</p>
                    <?= Html::a('Abrir Telegram', 'https://t.me/tu_usuario_telegram', ['class' => 'btn btn-primary', 'target' => '_blank']) ?>
                </div>
            </div>
        </div>
        <!-- Email Contact -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-envelope fa-3x text-danger mb-3"></i>
                    <h5 class="card-title">Correo Electrónico</h5>
                    <p class="card-text">Envíanos un correo electrónico y responderemos lo antes posible.</p>
                    <?= Html::a('Enviar Correo', 'mailto:soporte@tudominio.com', ['class' => 'btn btn-danger']) ?>
                </div>
            </div>
        </div>
        <!-- WhatsApp Contact -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fab fa-whatsapp fa-3x text-success mb-3"></i>
                    <h5 class="card-title">WhatsApp</h5>
                    <p class="card-text">También puedes contactarnos por WhatsApp si lo prefieres.</p>
                    <?= Html::a('Abrir WhatsApp', 'https://wa.me/1234567890', ['class' => 'btn btn-success', 'target' => '_blank']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="text-center my-5">
        <p class="text-muted">Nuestro equipo está disponible para ayudarte 24/7. ¡No dudes en contactarnos!</p>
    </div>
</div>