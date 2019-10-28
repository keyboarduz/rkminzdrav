<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\modules\admin\models\form\UploadForm;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Document */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Hujjatlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-view box box-primary">
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
                'date_of_admission',
                [
                    'attribute' => 'type',
                    'value' => function ($model) {
                        return \app\modules\admin\models\Document::getTypes()[$model->type];
                    }
                ],
                [
                    'attribute' => 'file',
                    'value' => function ($model) {
                        return Html::a(
                            $model->file,
                            "https://docs.google.com/gview?url=" . Url::to(['/'], true) . Yii::getAlias('@web/uploads/documents') . UploadForm::getMd5FilePath($model->file),
                            ['target' => '_blank', 'alt' => "Ko'rish", 'data-toggle'=>"tooltip", 'title'=>"Hujjatni ko'rish"]
                        );
                    },
                    'format' => 'raw',
                ],
                'description:ntext',
                'content:ntext',
                'document_number',
                [
                    'attribute' => 'created_at',
                    'format' => ['datetime', 'php: d.m.Y H:i:s']
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => ['datetime', 'php: d.m.Y H:i:s']
                ],
            ],
        ]) ?>
    </div>
</div>
