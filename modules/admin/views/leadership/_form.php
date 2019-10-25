<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\form\UploadForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Leadership */
/* @var $form yii\widgets\ActiveForm */
/* @var $imageModel \app\modules\admin\models\form\UploadForm */
?>

<div class="leadership-form box box-primary">
    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'],
    ]); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>

        <?php if ( !$model->isNewRecord ): ?>
            <?= Html::img(Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($model->photo), ['width' => 300], ['class' => 'img-responsive']) ?>
        <?php endif; ?>

        <?= $form->field($imageModel, 'imageFile')->fileInput() ?>

        <?= $form->field($model, 'email')->input('email') ?>

        <?= $form->field($model, 'phone')->textInput() ?>

        <?= $form->field($model, 'reception_days')->textInput() ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
