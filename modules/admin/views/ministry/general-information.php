<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\modules\admin\models\GeneralInformation
 */

use app\assets\TinymceAsset;
use yii\web\YiiAsset;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;


TinymceAsset::register($this);
$this->registerJsFile('/js/admin-news-form.js', ['depends' => [TinymceAsset::class, YiiAsset::class]]);

$this->title = Yii::t('app', 'Umumiy ma\'lumot');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box box-primary">
    <?php $form = ActiveForm::begin(); ?>

    <div class="box-body">

        <?= $form->field($model, 'content')->textarea(['id' => 'contentArea']) ?>

        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-flat btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
