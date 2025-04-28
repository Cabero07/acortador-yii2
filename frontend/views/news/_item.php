<?php

use yii\helpers\Html;

/** @var common\models\News $model */
?>
<div class="news-item">
    <h2><i class="fas fa-file-alt text-info"></i> <?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]) ?></h2>
    <p><small><i class="fas fa-user"></i> Publicado por <?= Html::encode($model->author->username) ?> el <?= Yii::$app->formatter->asDate($model->created_at) ?></small></p>
    <p><i class="fas fa-align-left"></i> <?= Yii::$app->formatter->asNtext($model->content) ?></p>
</div>