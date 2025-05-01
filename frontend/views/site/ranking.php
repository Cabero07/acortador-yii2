<?php

use yii\helpers\Html;

$this->title = 'Ranking de Usuarios';


?>
<div class="ranking">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title"><i class="fas fa-trophy"></i> <?= Html::encode($this->title) ?></h1>
            <p class="card-text">Consulta las posiciones de los usuarios más activos en la plataforma.</p>
        </div>
        <div class="card-body bg-light">
            <table class="table table-bordered table-hover">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>Posición</th>
                        <th>Usuario</th>
                        <th>Total de Clics</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $index => $user): ?>
                        <tr >
                            <td class="<?= $index === 0 ? 'bg-warning' : ($index === 1 ? 'bg-orange text-dark' : ($index === 2 ? 'bg-danger text-white' : '')) ?>"><strong>#<?= $index + 1 ?></strong></td>
                            <td><?= Html::encode($user['username']) ?></td>
                            <td class="text-center fw-bold"><?= $user['total_clicks'] ?? 0 ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>