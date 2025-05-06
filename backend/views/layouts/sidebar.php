<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <i class="fas fa-tools mr-2"></i>
        <span class="brand-text font-weight-light">Panel de Control</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Inicio', 'url' => ['site/index'], 'icon' => 'fas fa-home'],
                    ['label' => 'Ranking', 'url'=> ['user/ranking'], 'icon' => 'fas fa-trophy'],
                    ['label' => 'Pagos pendientes', 'url'=> ['withdraw/index'], 'icon' => 'fas fa-dollar-sign'],
                    ['label' => 'Activación de enlaces', 'url'=> ['link/index'], 'icon' => 'fas fa-link'],
                    ['label' => 'Gestión de Noticias', 'url'=> ['news/index'], 'icon' => 'fas fa-newspaper'],
                    ['label' => 'Gestión de Usuarios', 'url'=> ['user/manage'], 'icon' => 'fas fa-users-cog'],
                    ['label' => 'Logs', 'url'=> ['user/logs'], 'icon' => 'fas fa-file-alt'],
                    ['label' => 'Opciones', 'url'=> ['admin/options'], 'icon' => 'fas fa-cog'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->

        <!-- Sidebar Settings -->
        <a class="nav-link mt-3" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
        </a>
    </div>
    <!-- /.sidebar -->
</aside>

<?php
// Cargar Font Awesome para los iconos
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', [
    'integrity' => 'sha384-dyB8A0sH6Lk7m3gA9gQmMVmJvR3hQIx1Lb1CWU4LhV5W1nq1aF1jV8V0N8Vt4C5w',
    'crossorigin' => 'anonymous',
]);
?>