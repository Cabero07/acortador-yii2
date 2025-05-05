<?php
/** @var yii\web\View $this */
/** @var common\models\LinkStats[] $topLinks */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Enlaces Recomendados';
?>

<div class="recomends-index">
    <div class="text-center mb-4">
        <h1 class="display-4"><?= Html::encode($this->title) ?></h1>
        <p class="lead">Descubre los enlaces más populares y acórtalos con un solo clic.</p>
    </div>

    <table class="table table-hover table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Enlace</th>
                <th>Clics</th>
                <th>Acción</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($topLinks as $index => $linkStat): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td>
                        <a href="<?= Html::encode($linkStat->link->url) ?>" target="_blank" class="text-decoration-none">
                            <?= Html::encode($linkStat->link->url) ?>
                        </a>
                    </td>
                    <td><?= $linkStat->clicks ?></td>
                    <td>
                        <?= Html::a('<i class="fas fa-cut"></i> Acortar', Url::to(['site/create-link', 'url' => $linkStat->link->url]), [
                            'class' => 'btn btn-sm btn-primary',
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>