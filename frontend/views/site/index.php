<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Acortador de Enlaces';
?>

<div class="site-index">
    <div class="p-5 mb-4 text-center">
        <div class="container py-5">
            <h1 class="display-5 fw-bold">
                <i class="fas fa-link text-primary"></i> Bienvenido al <?= Html::encode($this->title) ?>!
            </h1>
            <p class="lead">Simplifica, comparte y rastrea tus enlaces con facilidad. Obtén estadísticas detalladas sobre las interacciones de tus enlaces.</p>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="fw-bold"><i class="fas fa-compress-arrows-alt text-success"></i> Acorta Enlaces</h3>
                        <p>Convierte enlaces largos en URLs cortas y fáciles de recordar.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="fw-bold"><i class="fas fa-chart-line text-info"></i> Rastrea Clics</h3>
                        <p>Obtén estadísticas detalladas sobre quién interactúa con tus enlaces.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h3 class="fw-bold"><i class="fas fa-share-alt text-warning"></i> Organiza y Comparte</h3>
                        <p>Gestiona tus enlaces en un solo lugar y compártelos fácilmente.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="jumbotron text-center">
        <h1>Acorta tus Enlaces</h1>
        <p class="lead">Convierte enlaces largos en URLs cortas y fáciles de compartir.</p>
    </div>

    <div class="body-content">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <?php $form = ActiveForm::begin(['action' => ['site/shorten'], 'method' => 'post']); ?>
                <?= $form->field($model, 'url')->textInput(['placeholder' => 'Introduce tu enlace aquí'])->label(false) ?>
                <div class="form-group text-center">
                    <?= Html::submitButton('Acortar Enlace', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>