<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use app\assets\MaterializeAsset;
use yii\helpers\Url;

MaterializeAsset::register($this);

$this->title = $name;
?>
<div class="row site-error">
    <div class="col s12 center">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="black-text" style="font-size: 20px">
            <?= nl2br(Html::encode($message)) ?>
        </div>
        <hr>
        <p>
            <a href="<?= Url::home() ?>" class="btn btn-small light-blue">Bosh sahifaga qaytish</a>
        </p>
    </div>
</div>
