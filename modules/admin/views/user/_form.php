<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model \app\modules\admin\models\CreateUserForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'username')->textInput() ?>
        <?= $form->field($model, 'email')->textInput() ?>
        <?= $form->field($model, 'password')->passwordInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
