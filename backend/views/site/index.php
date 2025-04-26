<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Panel de Administración';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Bienvenido al Panel de Administración</h1>
        <p class="lead">Utiliza las opciones a continuación para gestionar la aplicación.</p>
    </div>

    <div class="body-content">
        <div class="row">
            <!-- Gestión de Usuarios -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Gestión de Usuarios</h3>
                    </div>
                    <div class="card-body">
                        <p>Administra los usuarios registrados, sus roles y estados (habilitado/deshabilitado).</p>
                        <p><?= Html::a('Ir a Gestión de Usuarios', ['user/manage'], ['class' => 'btn btn-primary']) ?></p>
                    </div>
                </div>
            </div>

            <!-- Historial de Logs -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="card-title">Historial de Logs</h3>
                    </div>
                    <div class="card-body">
                        <p>Consulta el historial de cambios realizados por los administradores.</p>
                        <p><?= Html::a('Ver Logs', ['user/logs'], ['class' => 'btn btn-success']) ?></p>
                    </div>
                </div>
            </div>

            <!-- Configuración del Sistema -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h3 class="card-title">Configuración</h3>
                    </div>
                    <div class="card-body">
                        <p>Ajusta la configuración general de la aplicación y otras opciones avanzadas.</p>
                        <p><?= Html::a('Configurar', ['site/settings'], ['class' => 'btn btn-warning']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>