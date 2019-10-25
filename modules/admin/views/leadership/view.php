<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\modules\admin\models\form\UploadForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Leadership */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Rahbariyat', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leadership-view box box-primary">
    <div class="box-header">
        <?= Html::a('Yangilash', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a("O'chirish", ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => Yii::t('app', 'Siz rostdan ham ushbu elementni o`chirmoqchimisiz?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'position',
                [
                    'attribute' => 'photo',
                    'value' => function($model) {
                        return  Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($model->photo);
                    },
                    'format' => ['image', ['width' => 300]],
                ],
                'email',
                'phone',
                'reception_days',
            ],
        ]) ?>
    </div>
</div>
