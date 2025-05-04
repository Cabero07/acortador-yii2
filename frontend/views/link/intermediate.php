<?php

/** @var yii\web\View $this */
/** @var common\models\Link $link */

use yii\helpers\Html;

$this->title = 'Espere antes de continuar';
?>

<div class="intermediate-page text-center">
    <h1>Espere 15 segundos...</h1>
    <p>Estamos mostrando anuncios relevantes. Su enlace estará disponible pronto.</p>

    <!-- Temporizador -->
    <div id="timer" class="display-4 text-danger">15</div>

    <!-- Botón para continuar -->
    <?= Html::a('Continuar al enlace', $link->url, [
        'class' => 'btn btn-primary mt-3',
        'id' => 'continue-button',
        'style' => 'display: none;',
    ]) ?>
</div>

<script>
    let timer = 15;
    const timerElement = document.getElementById('timer');
    const continueButton = document.getElementById('continue-button');

    const countdown = setInterval(() => {
        timer--;
        timerElement.textContent = timer;

        if (timer <= 0) {
            clearInterval(countdown);
            continueButton.style.display = 'inline-block';
            timerElement.style.display = 'none';
        }
    }, 1000);
</script>