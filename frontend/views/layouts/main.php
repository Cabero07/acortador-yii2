<?php

/** @var \yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <?php
    $this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['position' => \yii\web\View::POS_END]);
    $this->registerJsFile('https://cdn.jsdelivr.net/npm/moment', ['position' => \yii\web\View::POS_END]);
    ?>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex flex-column h-100 bg-light">
    <?php $this->beginBody() ?>

    <header>
        <?php

        NavBar::begin([
            'brandLabel' => Html::tag('i', '', ['class' => 'fas fa-link me-2']) . 'Acortador',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-lg navbar-dark bg-dark',
            ],
        ]);

        $menuItems = [
            // Sección Inicio
            ['label' => Html::tag('i', '', ['class' => 'fas fa-home me-2']) . 'Inicio', 'url' => ['/site/index'], 'encode' => false],
            // Sección Ranking
            ['label' => Html::tag('i', '', ['class' => 'fas fa-trophy me-2']) . 'Ranking', 'url' => ['/site/ranking'], 'encode' => false],
            // Sección Links (Dropdown)
            [
                'label' => Html::tag('i', '', ['class' => 'fas fa-link me-2']) . 'Links',
                'url' => '#',
                'items' => [
                    ['label' => Html::tag('i', '', ['class' => 'fas fa-plus me-2']) . 'Agregar Link', 'url' => ['/site/create-link'], 'encode' => false],
                    ['label' => Html::tag('i', '', ['class' => 'fas fa-list me-2']) . 'Gestionar Links', 'url' => ['/site/links'], 'encode' => false],
                    ['label' => Html::tag('i', '', ['class' => 'fas fa-chart-bar me-2']) . 'Estadísticas', 'url' => ['/site/linkStats'], 'encode' => false],
                    ['label' => Html::tag('i', '', ['class' => 'fas fa-thumbs-up me-2']) . 'Recomendaciones', 'url' => ['/site/recomends'], 'encode' => false],
                ],
                'encode' => false,
                'dropDownOptions' => ['class' => 'dropdown-menu'],
            ],
            // Sección Ayuda (Dropdown)
            [
                'label' => Html::tag('i', '', ['class' => 'fas fa-question-circle me-2']) . 'Ayuda',
                'url' => '#',
                'items' => [
                    ['label' => Html::tag('i', '', ['class' => 'fas fa-info-circle me-2']) . 'Acerca de', 'url' => ['/site/about'], 'encode' => false],
                    ['label' => Html::tag('i', '', ['class' => 'fas fa-life-ring me-2']) . 'Soporte', 'url' => ['/site/support'], 'encode' => false],
                    ['label' => Html::tag('i', '', ['class' => 'fas fa-question me-2']) . 'FAQ', 'url' => ['/site/faq'], 'encode' => false],
                ],
                'encode' => false,
                'dropDownOptions' => ['class' => 'dropdown-menu'],
            ],
        ];

        if (Yii::$app->user->isGuest) {
            // Botón de Iniciar Sesión
            $menuItems[] = ['label' => Html::tag('i', '', ['class' => 'fas fa-sign-in-alt me-2']) . 'Iniciar Sesión', 'url' => ['/site/login'], 'encode' => false];
        } else {
            // Menú de Usuario (Dropdown)
            $userMenu = [
                ['label' => Html::tag('i', '', ['class' => 'fas fa-user me-2']) . 'Perfil', 'url' => ['/user/profile'], 'encode' => false],
                ['label' => Html::tag('i', '', ['class' => 'fas fa-list me-2']) . 'Actividad', 'url' => ['/site/activity'], 'encode' => false],
                ['label' => Html::tag('i', '', ['class' => 'fas fa-hand-holding-usd me-2']) . 'Retirar', 'url' => ['/withdraw/create'], 'encode' => false],
                ['label' => Html::tag('i', '', ['class' => 'fas fa-wallet me-2']) . 'Estado de Retiros', 'url' => ['/withdraw/index'], 'encode' => false],
                ['label' => Html::tag('i', '', ['class' => 'fas fa-newspaper me-2']) . 'Noticias', 'url' => ['/news/index'], 'encode' => false],
                ['label' => Html::tag('i', '', ['class' => 'fas fa-sign-out-alt me-2']) . 'Salir', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post'], 'encode' => false],
            ];

            $menuItems[] = [
                'label' => Html::tag('i', '', ['class' => 'fas fa-user-circle me-2']) . 'Usuario',
                'encode' => false,
                'items' => $userMenu,
                'dropDownOptions' => ['class' => 'dropdown-menu dropdown-menu-end'],
            ];
        }

        // Renderizar la barra de navegación
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto'],
            'items' => $menuItems,
        ]);

        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto bg-dark text-light py-3">
        <div class="container">
            <p class="float-start">&copy; <?php echo (date('Y')) ?> CaberoTech</p>
        </div>
        <div class="text-end">
            <b>Versión:</b> 1.1.0
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage(); ?>