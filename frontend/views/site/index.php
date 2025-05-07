<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Acortador de Enlaces';
?>
<div class="site-index">
    <!-- Encabezado -->
    <div class="text-center bg-light py-5">
        <div class="container">
            <h1 class="display-5 fw-bold">
                <i class="fas fa-link text-primary"></i> Bienvenido al <?= Html::encode($this->title) ?>!
            </h1>
            <p class="lead">Simplifica, comparte y rastrea tus enlaces con facilidad. Obtén estadísticas detalladas sobre las interacciones de tus enlaces.</p>
            <!-- Botón de WhatsApp -->
            <a href="https://chat.whatsapp.com/" class="btn btn-success btn-lg mt-3" target="_blank">
                <i class="fab fa-whatsapp me-2"></i> Únete a nuestro grupo de WhatsApp
            </a>
        </div>
    </div>

    <!-- Sección de Características -->
    <div class="container mb-5">
        <div class="row text-center">
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="fw-bold"><i class="fas fa-compress-arrows-alt text-success"></i> Acorta Enlaces</h3>
                        <p>Convierte enlaces largos en URLs cortas y fáciles de recordar.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="fw-bold"><i class="fas fa-chart-line text-info"></i> Rastrea Clics</h3>
                        <p>Obtén estadísticas detalladas sobre quién interactúa con tus enlaces.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="fw-bold"><i class="fas fa-share-alt text-warning"></i> Organiza y Comparte</h3>
                        <p>Gestiona tus enlaces en un solo lugar y compártelos fácilmente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Nueva Sección: Beneficios del Grupo -->
    <div class="bg-light py-5">
        <div class="container text-center">
            <h2 class="fw-bold">¿Por qué unirte a nuestro grupo de WhatsApp?</h2>
            <p class="lead">Conéctate con otros usuarios, recibe soporte directo de la administración y comparte tus ideas con la comunidad.</p>
            <a href="https://chat.whatsapp.com/" class="btn btn-outline-success btn-lg mt-3" target="_blank">
                <i class="fab fa-whatsapp me-2"></i> Únete al grupo ahora
            </a>
        </div>
    </div>
</div>