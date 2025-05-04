<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        Lamentamos el inconveniente. Este error ocurrió mientras procesábamos su solicitud.
    </p>
    <p>
        Si el problema persiste, por favor <a href="/contact">contáctenos</a> con detalles sobre lo que intentaba hacer.
    </p>
</div>