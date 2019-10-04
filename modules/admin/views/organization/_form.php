<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\modules\admin\models\Organization;
use app\modules\admin\models\form\UploadForm;
/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Organization */
/* @var $imageModel \app\modules\admin\models\form\UploadForm */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="organization-form box box-primary">
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput() ?>

        <?= $form->field($imageModel, 'imageFile')->fileInput() ?>

        <?php if ( !$model->isNewRecord ): ?>
            <?= Html::img(Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($model->photo), ['width' => 300]) ?>
        <?php endif; ?>

        <?= $form->field($model, 'leader')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput() ?>

        <?= $form->field($model, 'site')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'category')->dropDownList(Organization::getOrganizations()) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
