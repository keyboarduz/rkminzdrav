<?php
/* @var $this \yii\web\View */

use yii\helpers\Url;
?>

<div class="list-group">
    <a href="<?= Url::to(['/ministry/general-information']) ?>" class="list-group-item"><?= Yii::t('app', 'General information') ?></a>
    <a href="<?= Url::to(['/ministry/leadership']) ?>" class="list-group-item"><?=Yii::t('app', 'Leadership')?></a>
</div>