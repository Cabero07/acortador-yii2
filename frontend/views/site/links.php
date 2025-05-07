<?php

use yii\helpers\Html;
use yii\grid\GridView;

$this->title = 'Gestión de Enlaces';
?>

<div class="site-links">
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h1 class="card-title"><i class="fas fa-link"></i> <?= Html::encode($this->title) ?></h1>
            <p class="card-text">Gestiona todos tus enlaces acortados desde aquí.</p>
        </div>
        <div class="card-body bg-light">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <?= Html::a('<i class="fas fa-plus-circle"></i> Crear Nuevo Enlace', ['create-link'], ['class' => 'btn btn-success']) ?>
                <span class="text-muted"><i class="fas fa-info-circle"></i> Haz clic en los enlaces para redirigir.</span>
            </div>

            <div class="table-responsive">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'layout' => "{items}\n<div class='d-flex justify-content-between align-items-center mt-3'>{summary}{pager}</div>",
                    'tableOptions' => ['class' => 'table table-bordered table-hover align-middle'],
                    'columns' => [
                        [
                            'label' => '<i class="fas fa-image"></i> Ícono',
                            'encodeLabel' => false,
                            'format' => 'raw',
                            'value' => function ($model) {
                                $parsedUrl = parse_url($model->url);
                                $faviconUrl = isset($parsedUrl['host']) ? 'https://' . $parsedUrl['host'] . '/favicon.ico' : null;
                                return $faviconUrl
                                    ? Html::img($faviconUrl, ['alt' => 'Ícono', 'style' => 'width: 32px; height: 32px;'])
                                    : '<span class="text-muted">No disponible</span>';
                            },
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'attribute' => 'url',
                            'label' => '<i class="fas fa-globe"></i> URL Original',
                            'encodeLabel' => false,
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a('<i class="fas fa-external-link-alt"></i> ' . $model->url, $model->url, [
                                    'target' => '_blank',
                                    'class' => 'text-decoration-none',
                                ]);
                            },
                        ],
                        [
                            'attribute' => 'short_code',
                            'label' => '<i class="fas fa-compress-arrows-alt"></i> Enlace Acortado',
                            'encodeLabel' => false,
                            'format' => 'raw',
                            'value' => function ($model) {
                                return Html::a('<i class="fas fa-link"></i> ' . Yii::$app->request->hostInfo . '/' . $model->short_code, Yii::$app->request->hostInfo . '/' . $model->short_code, [
                                    'target' => '_blank',
                                    'class' => 'text-success text-decoration-none',
                                    'onclick' => "registerClick('{$model->short_code}')",
                                ]);
                            },
                        ],
                        [
                            'attribute' => 'description',
                            'label' => '<i class="fas fa-pencil-alt"></i> Descripción',
                            'encodeLabel' => false,
                            'format' => 'ntext',
                            'value' => function ($model) {
                                return $model->description ?: '';
                            },
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'attribute' => 'created_at',
                            'label' => '<i class="fas fa-calendar-alt"></i> Fecha de Creación',
                            'encodeLabel' => false,
                            'format' => 'datetime',
                        ],
                        [
                            'attribute' => 'is_active',
                            'label' => '<i class="fas fa-toggle-on"></i> Estado',
                            'encodeLabel' => false,
                            'format' => 'raw',
                            'value' => function ($model) {
                                return $model->is_active ? '<span class="badge bg-success">Activo</span>' : '<span class="badge bg-danger">Inactivo</span>';
                            },
                            'contentOptions' => ['class' => 'text-center'],
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => '<i class="fas fa-cogs"></i> Acciones',
                            'template' => '{copy} {delete}',
                            'buttons' => [
                                'copy' => function ($url, $model) {
                                    return Html::button('<i class="fas fa-copy"></i>', [
                                        'class' => 'btn btn-sm btn-outline-primary copy-btn',
                                        'title' => 'Copiar al portapapeles',
                                        'data-description' => $model->description ?: 'Sin descripción',
                                        'data-link' => Yii::$app->request->hostInfo . '/' . $model->short_code,
                                    ]);
                                },
                                'delete' => function ($url, $model) {
                                    return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                                        'title' => 'Eliminar',
                                        'class' => 'btn btn-sm btn-outline-danger',
                                        'data-confirm' => '¿Estás seguro de eliminar este enlace?',
                                        'data-method' => 'post',
                                    ]);
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.copy-btn').forEach(button => {
            button.addEventListener('click', function() {
                const description = this.getAttribute('data-description')?.trim(); // Obtener y limpiar espacios de la descripción
                const link = this.getAttribute('data-link');
                const content = description ? `${description}\n${link}` : link; // Si hay descripción, incluirla; de lo contrario, solo el enlace

                // Método alternativo para copiar al portapapeles
                const textarea = document.createElement('textarea');
                textarea.value = content;
                document.body.appendChild(textarea);
                textarea.select();

                try {
                    document.execCommand('copy');
                    alert('¡Texto copiado al portapapeles!');
                } catch (err) {
                    alert('Error al copiar al portapapeles. Intenta nuevamente.');
                    console.error('Error:', err);
                }

                document.body.removeChild(textarea); // Eliminar el elemento temporal
            });
        });
    });
</script>