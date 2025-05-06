<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Redirigiendo...';
$redirectUrl = Url::to(['link/complete-redirect', 'shortCode' => $link->short_code], true);
$adDisplayTime = Yii::$app->settings->get('ad_display_time', 5);
$adskeeperCode = Yii::$app->settings->get('adskeeper_code', '');
?>
<div class="intermediate-page text-center">
    <h1>Espere un momento...</h1>
    <p>Será redirigido en <span id="countdown"><?= $adDisplayTime ?></span> segundos.</p>

    <div class="ads">
        <h2>Anuncio</h2>
        <?= $adskeeperCode ?>
    </div>

    <p id="redirect-button" style="display: none;">
        <?= Html::a('Haga clic aquí si no es redirigido automáticamente', $redirectUrl, ['class' => 'btn btn-primary']) ?>
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
            window.location.href = '$redirectUrl';
        } else {
            countdownElement.innerText = countdown;
            countdown--;
        }
    }, 1000);
JS;
$this->registerJs($script);
?>