<?php

use yii\helpers\Html;

$this->title = 'Estadísticas de Enlaces';
?>
<div class="link-stats mt-5">
    <h1 class="text-center text-primary"><i class="fas fa-chart-line"></i> <?= Html::encode($this->title) ?></h1>
    <p class="text-center text-secondary">Visualiza las visitas diarias de tus enlaces en detalle.</p>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <button id="prevWeek" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-chevron-left"></i> Semana Anterior
                        </button>
                        <h5 id="currentWeek" class="text-center mb-0">Semana Actual</h5>
                        <button id="nextWeek" class="btn btn-outline-primary btn-sm" disabled>
                            Semana Siguiente <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="linkStatsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Detalles -->
        <div class="col-lg-10">
            <div class="card shadow-lg mb-4">
                <div class="card-body">
                    <h5 class="card-title text-center"><i class="fas fa-table"></i> Detalles de las Visitas</h5>
                    <table class="table table-bordered table-hover">
                        <thead class="bg-primary text-white text-center">
                            <tr>
                                <th>Día</th>
                                <th>Enlace</th>
                                <th>Visitas</th>
                            </tr>
                        </thead>
                        <tbody id="detailsTableBody">
                            <!-- El contenido será generado dinámicamente -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Pasar datos de PHP a JavaScript
$this->registerJsVar('stats', $stats);
?>
<?php
// Registrar JavaScript para manejar el gráfico
$this->registerJsFile('@web/js/linkStatsChart.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>