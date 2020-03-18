<?php
/* @var $this \yii\web\View */

use yii\helpers\Url;
?>

<div class="collection hoverable">
    <a href="<?= Url::to(['/ministry/general-information']) ?>" class="collection-item"><?= Yii::t('app', 'General information') ?></a>
    <a href="<?= Url::to(['/ministry/leadership']) ?>" class="collection-item"><?=Yii::t('app', 'Leadership')?></a>
</div>