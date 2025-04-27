use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Listado de Enlaces';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-links">
    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'], // Columna de índice

            'url:url', // URL original
            [
                'attribute' => 'short_code',
                'label' => 'Enlace Acortado',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a(Yii::$app->request->hostInfo . '/' . $model->short_code, Yii::$app->request->hostInfo . '/' . $model->short_code, ['target' => '_blank']);
                },
            ],
            'clicks', // Número de clics
            'created_at:datetime', // Fecha de creación

            ['class' => 'yii\grid\ActionColumn'], // Columnas de acciones (editar/borrar)
        ],
    ]); ?>
</div>