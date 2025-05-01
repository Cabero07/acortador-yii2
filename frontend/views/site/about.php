<?php
/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Acerca de Nosotros';
?>
<div class="about-container" style="margin-top: 50px;">
    <div class="text-center my-5">
        <h1 class="display-4 text-primary"><?= Html::encode($this->title) ?></h1>
        <p class="lead text-secondary">Descubre cómo funciona nuestra plataforma y cómo puedes beneficiarte de ella.</p>
    </div>
    <div class="row justify-content-center">
        <!-- Sección de Acortador -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-link fa-3x text-info mb-3"></i>
                    <h5 class="card-title">Acortador de Enlaces</h5>
                    <p class="card-text">Convierte enlaces largos en URLs cortas y fáciles de compartir.</p>
                </div>
            </div>
        </div>
        <!-- Sección de Ranking -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-trophy fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Ranking Diario</h5>
                    <p class="card-text">Los usuarios con más clics en sus enlaces ganarán premios diarios.</p>
                </div>
            </div>
        </div>
        <!-- Sección de Ganancias -->
        <div class="col-md-4">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-dollar-sign fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Ganancias</h5>
                    <p class="card-text">Cada 1000 visitas equivalen a $4.2 USD. Retira tus ganancias al alcanzar $10.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <!-- Métodos de Retiro -->
        <div class="col-md-6">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <i class="fas fa-wallet fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Métodos de Retiro</h5>
                    <p class="card-text">Retira tus ganancias a través de MLC, CUP o QVAPAY.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="text-center my-5">
        <p class="text-muted">Nuestra plataforma está diseñada para ayudarte a crecer y monetizar tus enlaces. ¡Empieza hoy!</p>
    </div>
</div>