<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\User $user */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div>
    <p>Hola <?= Html::encode($user->username) ?>,</p>
    <p>Sigue el enlace a continuación para restablecer tu contraseña:</p>
    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>