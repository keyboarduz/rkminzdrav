<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use app\modules\admin\models\Category;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\News */
/* @var $form yii\widgets\ActiveForm */
/* @var $uploadModel \app\modules\admin\models\form\UploadForm */

$enableClientValidationForFile = true;
$styleDisplayForFileInput = 'block';
if (!$model->isNewRecord) {
    $enableClientValidationForFile = false;
    $styleDisplayForFileInput = 'none';
}

$model->created_at = is_int($model->created_at) ? date('d.m.Y', $model->created_at) : $model->created_at;
?>

<div class="news-form box box-primary">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <div class="box-body table-responsive">

        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'category_id')->dropDownList(Category::find()->select(['title', 'id'])->indexBy('id')->column()) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($model, 'status')->dropDownList($model->getStatuses()) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'created_at')->textInput(['placeholder'=> 'dd.mm.YYYY'])?>
            </div>
        </div>

        <?php if (!$model->isNewRecord): ?>
            <button class="btn btn-sm btn-primary" id="button_update">Rasmni o'zgartirish</button>
            <button class="btn btn-sm btn-warning" id="button_cancel" style="display: none;">Bekor qilish</button>
            <div class="form-group" id="news_photo">
                <label class="control-label" for="uploaded_image">Asosiy rasm</label>
                <?= Html::img(
                    ['@web' . $model->image_url],
                    [
                        'id' => 'uploaded_image',
                        'class' => 'img-rounded img-responsive',
                        'width' => '400'
                    ]
                )?>
            </div>
            <input id="upload_file_input" type="hidden" name="upload_file" value="no">
        <?php endif; ?>

        <div id="file_input" style="display: <?= $styleDisplayForFileInput ?>">
            <?= $form->field($uploadModel, 'imageFile', ['enableClientValidation' => $enableClientValidationForFile])
                ->label('Asosiy rasm')
                ->fileInput(); ?>
        </div>

        <?= $form->field($model, 'description')->textarea(['rows' => 3]); ?>

        <?= $form->field($model, 'content')->widget(CKEditor::class, [
            'options' => ['rows' => 6],
            'preset' => 'full',
            'kcfinder'=>true,
        ]) ?>

    </div>
    <div class="box-footer">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
