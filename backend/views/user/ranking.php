<?php

use yii\helpers\Html;

$this->title = 'Ranking de Usuarios';
?>
<div class="ranking">
    <div class="container mt-5">
        <div class="row">
            <!-- Tabla de Visitas -->
            <div class="col-lg-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title"><i class="fas fa-chart-bar"></i> Top 10 Usuarios por Visitas</h3>
                    </div>
                    <div class="card-body bg-light">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-secondary text-white text-center">
                                <tr>
                                    <th>Posición</th>
                                    <th>Usuario</th>
                                    <th>Total de Visitas</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usersByVisits as $index => $user): ?>
                                    <tr>
                                        <td class="text-center"><?= $index + 1 ?></td>
                                        <td class="text-center"><?= Html::encode($user['username']) ?></td>
                                        <td class="text-center"><?= $user['total_clicks'] ?? 0 ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Tabla de Referidos -->
            <div class="col-lg-6">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-success text-white">
                        <h3 class="card-title"><i class="fas fa-users"></i> Top 10 Usuarios por Referidos</h3>
                    </div>
                    <div class="card-body bg-light">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-secondary text-white text-center">
                                <tr>
                                    <th>Posición</th>
                                    <th>Usuario</th>
                                    <th>Total de Referidos</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usersByReferrals as $index => $user): ?>
                                    <tr>
                                        <td class="text-center"><?= $index + 1 ?></td>
                                        <td class="text-center"><?= Html::encode($user['username']) ?></td>
                                        <td class="text-center"><?= $user['total_referrals'] ?? 0 ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>