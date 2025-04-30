<?php

use yii\helpers\Html;

$this->title = 'Ranking de Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-logs ">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        </div>
        <div class="card-body bg-light">
            <!-- Formulario de Búsqueda y Filtros -->
            <div class="filter-form mb-4">

                <!-- Tabla de Usuarios -->
                <table class="table table-hover table-striped">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>Posición</th>
                            <th>Usuario</th>
                            <th>Total de Clics</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $index => $user): ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= Html::encode($user['username']) ?></td>
                                <td><?= $user['total_clicks'] ?? 0 ?></td> <!-- Usar 'total_clicks' como clave del array -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>