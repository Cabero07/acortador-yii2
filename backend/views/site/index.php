<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Panel de Administración';
?>
<div class="site-index">
    <h1><i class="fas fa-tools"></i> <?= Html::encode($this->title) ?></h1>

    <div class="row">
        <!-- Gestión de Usuarios -->
        <div class="col-lg-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header"><i class="fas fa-users"></i> Gestión de Usuarios</div>
                <div class="card-body">
                    <p class="card-text">Administra los usuarios registrados, sus roles y estados.</p>
                    <?= Html::a('Ir a Gestión de Usuarios <i class="fas fa-arrow-right"></i>', ['user/manage'], ['class' => 'btn btn-light']) ?>
                </div>
            </div>
        </div>

        <!-- Historial de Logs -->
        <div class="col-lg-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header"><i class="fas fa-history"></i> Historial de Logs</div>
                <div class="card-body">
                    <p class="card-text">Consulta el historial de cambios realizados por los administradores.</p>
                    <?= Html::a('Ver Logs <i class="fas fa-arrow-right"></i>', ['user/logs'], ['class' => 'btn btn-light']) ?>
                </div>
            </div>
        </div>

        <!-- Configuración -->
        <div class="col-lg-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-header"><i class="fas fa-cogs"></i> Configuración</div>
                <div class="card-body">
                    <p class="card-text">Ajusta la configuración general de la aplicación.</p>
                    <?= Html::a('Ir a Configuración <i class="fas fa-arrow-right"></i>', ['admin/options'], ['class' => 'btn btn-light']) ?>
                </div>
            </div>
        </div>
    </div>
</div>