<?php

use yii\helpers\Html;

$this->title = 'Ranking de Usuarios';


?>
<div class="ranking">
    <div class="card shadow-sm mb-4 col-lg-6">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title"><i class="fas fa-trophy"></i> <?= Html::encode($this->title) ?></h1>
            <p class="card-text">Consulta las posiciones de los usuarios más activos en la plataforma.</p>
        </div>
        <div class="card-body  bg-light">
            <table class="table table-bordered table-hover">
                <thead class="bg-secondary text-white text-center">
                    <tr>
                        <th>Posición</th>
                        <th>Usuario</th>
                        <th>Total de Clics</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $index => $user): ?>
                        <tr >
                            <td class="text-center fw-bold text-black <?= $index === 0 ? 'bg-warning' : ($index === 1 ? 'bg-secondary' : ($index === 2 ? 'bg-danger' : '')) ?>"><strong>#<?= $index + 1 ?></strong></td>
                            <td class="text-center fw-bold text-black <?= $index === 0 ? 'bg-warning' : ($index === 1 ? 'bg-secondary' : ($index === 2 ? 'bg-danger' : '')) ?>"><?= Html::encode($user['username']) ?></td>
                            <td class="text-center fw-bold text-black <?= $index === 0 ? 'bg-warning' : ($index === 1 ? 'bg-secondary' : ($index === 2 ? 'bg-danger' : '')) ?>""><?= $user['total_clicks'] ?? 0 ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>