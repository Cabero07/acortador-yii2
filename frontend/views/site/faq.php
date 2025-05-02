<?php

use yii\helpers\Html;

$this->title = 'Preguntas Frecuentes (FAQ)';
?>
<div class="faq-container" style="margin-top: 50px;">
    <div class="text-center my-5">
        <h1 class="display-4 text-primary"><i class="fas fa-question-circle"></i> <?= Html::encode($this->title) ?></h1>
        <p class="lead text-secondary">Encuentra respuestas a las preguntas más comunes sobre el uso de nuestra plataforma.</p>
    </div>
    <div class="accordion" id="faqAccordion">
        <!-- Pregunta 1 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading1">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse1" aria-expanded="true" aria-controls="faqCollapse1">
                    <i class="fas fa-link text-primary"></i> ¿Cómo funciona el acortador de enlaces?
                </button>
            </h2>
            <div id="faqCollapse1" class="accordion-collapse collapse show" aria-labelledby="faqHeading1" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Nuestro acortador convierte enlaces largos en URLs cortas y fáciles de compartir. También puedes rastrear estadísticas de clics para conocer el rendimiento de tus enlaces.
                </div>
            </div>
        </div>
        <!-- Pregunta 2 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading2">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse2" aria-expanded="false" aria-controls="faqCollapse2">
                    <i class="fas fa-dollar-sign text-success"></i> ¿Cómo puedo ganar dinero con mis enlaces?
                </button>
            </h2>
            <div id="faqCollapse2" class="accordion-collapse collapse" aria-labelledby="faqHeading2" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Por cada 1000 clics en tus enlaces, ganas $4 USD. Una vez que alcances un balance mínimo de $10, podrás retirar tus ganancias a través de métodos como MLC, CUP o QVAPAY.
                </div>
            </div>
        </div>
        <!-- Pregunta 3 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading3">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse3" aria-expanded="false" aria-controls="faqCollapse3">
                    <i class="fas fa-users text-warning"></i> ¿Qué son los referidos y cómo funcionan?
                </button>
            </h2>
            <div id="faqCollapse3" class="accordion-collapse collapse" aria-labelledby="faqHeading3" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Los referidos son usuarios que se registran en la plataforma a través de tu enlace personal. Por cada clic que generen los enlaces de tus referidos, recibirás $0.002 en tu balance.
                </div>
            </div>
        </div>
        <!-- Pregunta 4 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading4">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse4" aria-expanded="false" aria-controls="faqCollapse4">
                    <i class="fas fa-chart-line text-info"></i> ¿Dónde puedo ver las estadísticas de mis enlaces?
                </button>
            </h2>
            <div id="faqCollapse4" class="accordion-collapse collapse" aria-labelledby="faqHeading4" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Puedes acceder a las estadísticas detalladas de tus enlaces en la sección "Gestión de Enlaces" de tu perfil. Allí encontrarás datos como el número de clics y la fecha de creación.
                </div>
            </div>
        </div>
        <!-- Pregunta 5 -->
        <div class="accordion-item">
            <h2 class="accordion-header" id="faqHeading5">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqCollapse5" aria-expanded="false" aria-controls="faqCollapse5">
                    <i class="fas fa-wallet text-primary"></i> ¿Cuáles son los métodos de retiro disponibles?
                </button>
            </h2>
            <div id="faqCollapse5" class="accordion-collapse collapse" aria-labelledby="faqHeading5" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                    Actualmente, ofrecemos retiros a través de MLC, CUP y QVAPAY. Puedes seleccionar tu método preferido desde la configuración de tu perfil.
                </div>
            </div>
        </div>
    </div>
</div>