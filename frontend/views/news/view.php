<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\News $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><small>Publicado por <?= Html::encode($model->author->username) ?> el <?= Yii::$app->formatter->asDate($model->created_at) ?></small></p>
    <p><?= Yii::$app->formatter->asNtext($model->content) ?></p>
</div>