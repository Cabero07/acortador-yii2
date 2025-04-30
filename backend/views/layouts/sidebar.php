<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <span class="brand-text font-weight-light">Panel de control</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    ['label' => 'Inicio', 'url' => ['site/index'], 'iconStyle' => 'far'],
                    ['label' => 'Gestión de Usuarios', 'url'=> ['user/manage'] ,'iconStyle' => 'far'],
                    ['label' => 'Logs', 'url'=> ['user/logs'] ,'iconStyle' => 'far'],
                    ['label' => 'Gestión de Noticias', 'url'=> ['news/index'] ,'iconStyle' => 'far'],
                    ['label' => 'Ranking', 'url'=> ['user/ranking'] ,'iconStyle' => 'far'],
                    ['label' => 'Opciones', 'url'=> ['site/settings'] ,'iconStyle' => 'far'],
                    
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
    </div>
    <!-- /.sidebar -->
</aside>