<?php
/** @var yii\web\View $this */
/** @var common\models\Link $link */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Redirigiendo...';

// URL de redirección final
$redirectUrl = Url::to(['link/complete-redirect', 'shortCode' => $link->short_code], true);

// JavaScript para el contador
$script = <<<JS
    let countdown = 5; // Tiempo en segundos
    const countdownElement = document.getElementById('countdown');
    const redirectButton = document.getElementById('redirect-button');

    const interval = setInterval(() => {
        if (countdown <= 0) {
            clearInterval(interval);
            redirectButton.style.display = 'inline-block'; // Mostrar botón
            window.location.href = '$redirectUrl'; // Redirigir automáticamente
        } else {
            countdownElement.innerText = countdown;
            countdown--;
        }
    }, 1000);
JS;

$this->registerJs($script);
?>

<div class="intermediate-page text-center">
    <h1>Espere un momento...</h1>
    <p>Será redirigido en <span id="countdown">5</span> segundos.</p>
    
    <div class="ads">
        <h2>Anuncio</h2>
        <p>Este es un espacio reservado para anuncios.</p>
        <!-- Aquí puedes incluir contenido dinámico para los anuncios -->
    </div>
    
    <p id="redirect-button" style="display: none;">
        <?= Html::a('Haga clic aquí si no es redirigido automáticamente', $redirectUrl, ['class' => 'btn btn-primary']) ?>
    </p>
</div>