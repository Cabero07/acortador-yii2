<?php

/** @var yii\web\View $this */
/** @var int $totalClicks */
/** @var float $totalEarnings */
/** @var string $latestNews */

use yii\helpers\Html;
use yii\frontend\controllers\SiteController;

$this->title = 'Dashboard';
?>
<div class="dashboard-index">
    <div class="container">
        <h1 class="mb-4"><i class="fas fa-chart-pie text-primary"></i> <?= Html::encode($this->title) ?></h1>

        <div class="row">
            <!-- Card: Total Clicks -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">
                        <h2 class="card-title text-success"><i class="fas fa-mouse-pointer"></i></h2>
                        <h4 class="card-text">Total de Clics</h4>
                        <p class="card-text display-6"><?= number_format($totalClicks) ?></p>
                    </div>
                </div>
            </div>

            <!-- Card: Total Earnings -->
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card shadow h-100">
                    <div class="card-body text-center">
                        <h2 class="card-title text-warning"><i class="fas fa-dollar-sign"></i></h2>
                        <h4 class="card-text">Ganancias Totales</h4>
                        <p class="card-text display-6">$<?= number_format($totalEarnings, 2) ?></p>
                    </div>
                </div>
            </div>

            <!-- Card: Latest News -->
            <div class="dashboard-news">
                <h3>Últimas Noticias</h3>
                <?php if ($latestNews): ?>
                    <div class="news-item">
                        <h4><?= \yii\helpers\Html::encode($latestNews->title) ?></h4>
                        <p><?= \yii\helpers\Html::encode($latestNews->content) ?></p>
                        <small>Publicado el <?= Yii::$app->formatter->asDate($latestNews->created_at, 'long') ?></small>
                    </div>
                <?php else: ?>
                    <p>No hay noticias disponibles en este momento.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>