<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\admin\models\GeneralInformation
 */

use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;

$this->title = Yii::t('app', 'Umumiy ma\'lumot');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">
        <?= $form->field($model, 'content')->widget(CKEditor::class, [
            'options' => ['rows' => 6],
            'preset' => 'full',
//            'kcfinder'=>true,
            'clientOptions' => [
                'stylesSet' => ['name' => 'Custom Image', 'element' => 'img', 'attributes' => ['class' => 'responsive-img']]
            ]
        ]) ?>

        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-flat btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
