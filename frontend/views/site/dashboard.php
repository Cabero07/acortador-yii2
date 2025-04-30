<?php
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var int $totalClicks */
/** @var float $totalEarnings */
/** @var common\models\News|null $latestNews */

$this->title = 'Dashboard';
?>
<div class="site-dashboard">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <div class="icon mb-3">
                        <i class="fas fa-mouse-pointer fa-3x text-primary"></i>
                    </div>
                    <h5 class="card-title">Total de Clics</h5>
                    <p class="card-text display-4"><?= Html::encode($totalClicks) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <div class="icon mb-3">
                        <i class="fas fa-dollar-sign fa-3x text-success"></i>
                    </div>
                    <h5 class="card-title">Balance Acumulado</h5>
                    <p class="card-text display-4">$<?= Html::encode(number_format(Yii::$app->user->identity->balance, 2)) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-center shadow">
                <div class="card-body">
                    <div class="icon mb-3">
                        <i class="fas fa-newspaper fa-3x text-info"></i>
                    </div>
                    <h5 class="card-title">Última Noticia</h5>
                    <?php if ($latestNews): ?>
                        <p class="card-text">
                            <?= Html::encode($latestNews->title) ?>
                            <br>
                            <small class="text-muted">Publicado en: <?= Yii::$app->formatter->asDate($latestNews->created_at) ?></small>
                        </p>
                        <a href="#" class="btn btn-outline-info">Leer más</a>
                    <?php else: ?>
                        <p class="text-muted">No hay noticias disponibles.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>