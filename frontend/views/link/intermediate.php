<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Redirigiendo...';
$redirectUrl = Url::to(['link/complete-redirect', 'shortCode' => $link->short_code], true);
$adDisplayTime = Yii::$app->settings->get('ad_display_time', 5);
$adskeeperCode = Yii::$app->settings->get('adskeeper_code', ''); // Anuncio principal
$adCode2 = Yii::$app->settings->get('ad_code_2', ''); // Segundo anuncio
$adCode3 = Yii::$app->settings->get('ad_code_3', ''); // Tercer anuncio
?>
<div class="intermediate-page text-center">
    <h1>Espere un momento...</h1>
    <p>Podrá acceder al enlace en <span id="countdown"><?= $adDisplayTime ?></span> segundos.</p>

    <!-- Anuncios -->
    <div class="ads">
        <h2>Anuncio Principal</h2>
        <?= $adskeeperCode ?>
    </div>
    
    <div class="ads">
        <h2>Segundo Anuncio</h2>
        <?= $adCode2 ?>
    </div>
    
    <div class="ads">
        <h2>Tercer Anuncio</h2>
        <?= $adCode3 ?>
    </div>

    <!-- Botón de redirección manual -->
    <p id="redirect-button" style="display: none;">
        <?= Html::a('Acceder al enlace', $redirectUrl, ['class' => 'btn btn-primary']) ?>
    </p>
</div>

<?php
$script = <<<JS
    let countdown = $adDisplayTime;
    const countdownElement = document.getElementById('countdown');
    const redirectButton = document.getElementById('redirect-button');

    const interval = setInterval(() => {
        if (countdown <= 0) {
            clearInterval(interval);
            redirectButton.style.display = 'inline-block';
        } else {
            countdownElement.innerText = countdown;
            countdown--;
        }
    }, 1000);
JS;
$this->registerJs($script);
?>