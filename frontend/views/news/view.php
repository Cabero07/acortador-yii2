<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\News $model */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Noticias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">
    <h1><i class="fas fa-newspaper text-primary"></i> <?= Html::encode($this->title) ?></h1>
    <p><small><i class="fas fa-user"></i> Publicado por <?= Html::encode($model->author->username) ?> el <?= Yii::$app->formatter->asDate($model->created_at) ?></small></p>
    <p><i class="fas fa-align-left"></i> <?= Yii::$app->formatter->asNtext($model->content) ?></p>
</div>