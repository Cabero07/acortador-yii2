<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Acortador de Enlaces';
?>

<div class="site-index">
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