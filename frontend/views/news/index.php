<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Noticias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <h1><i class="fas fa-newspaper text-primary"></i> <?= Html::encode($this->title) ?></h1>

    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_item',
        'summary' => false,
        'options' => [
            'class' => 'list-group',
        ],
        'itemOptions' => [
            'class' => 'list-group-item',
        ],
    ]); ?>
</div>