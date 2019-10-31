<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\modules\admin\models\Document;
use app\modules\admin\models\form\UploadForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Document */
/* @var $form yii\widgets\ActiveForm */
/* @var $fileModel \app\modules\admin\models\form\UploadForm */
?>

<div class="document-form box box-primary">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'date_of_admission')->textInput() ?>

        <?= $form->field($model, 'category')->dropDownList(Document::getCategories()) ?>

        <?= $form->field($model, 'type_document')->dropDownList(Document::getTypes()) ?>

        <?php if ( !$model->isNewRecord ): ?>

            <iframe src="https://docs.google.com/gview?url=<?=Url::to(['/'], true) . Yii::getAlias('@web/uploads/documents') . UploadForm::getMd5FilePath($model->file)?>&embedded=true"></iframe>
        <?php endif; ?>

        <?= $form->field($fileModel, 'file')->fileInput() ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'document_number')->textInput(['maxlength' => true]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
