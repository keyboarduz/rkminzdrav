<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\User */



$this->title = 'Foydalanuvchini O\'zgartirish: ' . $model[1]->username;
$this->params['breadcrumbs'][] = ['label' => 'Foydalanuvchilar', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model[1]->username, 'url' => ['view', 'id' => $model[1]->id]];
$this->params['breadcrumbs'][] = 'O\'zgartirish';
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model[0],
    ]) ?>

</div>
