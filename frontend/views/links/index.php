<?php
/** @var $links common\models\Links[] */
?>

<div class="links">
    <?php foreach ($links as $link): ?>
        <div class="link">
            <a href="<?= $links->url ?>" target="_blank" onclick="registerClick(<?= $links->id ?>)">
                <?= $links->title ?>
            </a>
        </div>
    <?php endforeach; ?>
</div>

<?php
$this->registerJsFile('@web/js/registerClick.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>