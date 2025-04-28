<?php

use yii\helpers\Html;

/** @var common\models\News $model */
?>
<div class="news-item">
    <h2><?= Html::a(Html::encode($model->title), ['view', 'id' => $model->id]) ?></h2>
    <p><small>Publicado por <?= Html::encode($model->author->username) ?> el <?= Yii::$app->formatter->asDate($model->created_at) ?></small></p>
    <p><?= Yii::$app->formatter->asNtext($model->content) ?></p>
</div>