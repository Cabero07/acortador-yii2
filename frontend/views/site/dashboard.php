<?php

/** @var yii\web\View $this */
/** @var int $totalClicks */
/** @var float $totalEarnings */
/** @var string $latestNews */

use yii\helpers\Html;


$this->title = 'Dashboard';
?>
<div class="dashboard-index">
    <div class="container">
        <h1 class="mb-4"><i class="fas fa-chart-pie text-primary"></i> <?= Html::encode($this->title) ?></h1>

        <div class="row">
            <!-- Contador de clics -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <div class="icon mb-3">
                            <i class="fas fa-mouse-pointer fa-3x text-primary"></i>
                        </div>
                        <h5 class="card-title">Total de Clics</h5>
                        <p class="card-text display-4"><?= number_format($totalClicks) ?></p>
                    </div>
                </div>
            </div>

            <!-- Balance acumulado -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <div class="icon mb-3">
                            <i class="fas fa-dollar-sign fa-3x text-success"></i>
                        </div>
                        <h5 class="card-title">Balance Acumulado</h5>
                        <p class="card-text display-4">$<?= number_format($totalEarnings, 2) ?></p>
                    </div>
                </div>
            </div>

            <!-- Última noticia -->
            <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card text-center shadow">
                    <div class="card-body">
                        <div class="icon mb-3">
                            <i class="fas fa-newspaper fa-3x text-info"></i>
                        </div>
                        <h5 class="card-title">Última Noticia</h5>
                        <?php if ($latestNews): ?>
                            <h6 class="card-subtitle mb-2 text-muted"><?= Yii::$app->formatter->asDate($latestNews->created_at, 'long') ?></h6>
                            <p class="card-text"><?= \yii\helpers\Html::encode($latestNews->content) ?></p>
                        <?php else: ?>
                            <p class="card-text">No hay noticias disponibles.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>