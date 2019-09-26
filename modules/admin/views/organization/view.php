<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\models\form\UploadForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Organization */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-view box box-primary">
    <div class="box-header">
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //'id',
                'name:ntext',
                [
                    'attribute' => 'photo',
                    'value' => function($model) {
                        return  Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($model->photo);
                    },
                    'format' => ['image', ['width' => 300]],
                ],
                'leader',
                'address:ntext',
                'phone',
                'email:email',
                'site',
                'category',
            ],
        ]) ?>
    </div>
</div>
