<?php

use yii\helpers\Html;

$this->title = 'Ranking de Usuarios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ranking">
    <h1><?= Html::encode($this->title) ?></h1>
    <table class="table table-bordered">
        <thead>
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