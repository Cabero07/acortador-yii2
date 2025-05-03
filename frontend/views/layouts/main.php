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
            'options' => [
                'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
            ],
        ]);
        $menuItems = [
            ['label' => 'Inicio', 'url' => ['/site/index']],
            ['label' => 'Gestión de enlaces', 'url' => ['/site/links']],
            ['label' => 'Ranking', 'url' => ['/site/ranking']],
        ];

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
            'items' => $menuItems,
        ]);
        if (Yii::$app->user->isGuest) {
            echo Html::tag('div', Html::a('Crear Cuenta', ['/site/signup'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
            echo Html::tag('div', Html::a('Acceder', ['/site/login'], ['class' => ['btn btn-link login text-decoration-none']]), ['class' => ['d-flex']]);
        } else {
            echo Html::beginTag('div', ['class' => 'dropdown']);
            echo Html::button(
                'Usuario (' . Yii::$app->user->identity->username . ') <span class="caret"></span>',
                [
                    'class' => 'btn btn-secondary dropdown-toggle',
                    'type' => 'button',
                    'id' => 'userMenu',
                    'data-bs-toggle' => 'dropdown',
                    'aria-expanded' => 'false',
                ]
            );
            echo Html::beginTag('ul', ['class' => 'dropdown-menu', 'aria-labelledby' => 'userMenu']);
            echo Html::tag('li', Html::a('Perfil', ['/user/profile'], ['class' => 'dropdown-item']));
            echo Html::tag('li', Html::a('Actividad', ['/site/activity'], ['class' => 'dropdown-item']));
            echo Html::tag('li', Html::a('Noticias', ['/news/index'], ['class' => 'dropdown-item']));
            echo Html::tag('li', Html::a('Configuraciones', ['/site/settings'], ['class' => 'dropdown-item']));
            echo Html::tag('li', Html::a('Soporte', ['/site/support'], ['class' => 'dropdown-item']));
            echo Html::tag('li', Html::a('Preguntas Frecuentes', ['/site/faq'], ['class' => 'dropdown-item']));
            echo Html::tag('li', Html::a('Acerca de', ['/site/about'], ['class' => 'dropdown-item']));
            echo Html::tag('li', Html::beginForm(['/site/logout'], 'post', ['class' => 'bg-danger'])
                . Html::submitButton('Salir', ['class' => 'dropdown-item'])
                . Html::endForm());
            echo Html::endTag('ul');
            echo Html::endTag('div');
        }
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
            <p class="float-start">Copyright &copy; <?php echo (date('Y')) ?> CaberoTech</p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
