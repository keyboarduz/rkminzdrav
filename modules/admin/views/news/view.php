<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view box box-primary">
    <div class="box-header">
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                [
                    'attribute' => 'author_id',
                    'value' => $model->author->username,
                ],
                [
                    'attribute' => 'category_id',
                    'value' => $model->category->title,
                ],
                [
                    'attribute' => 'status',
                    'value' => $model->getStatuses()[$model->status],
                ],
                'viewed',
                'created_at:datetime',
                'updated_at:datetime',
                [
                    'attribute' => 'image_url',
                    'label' => 'Asosiy rasm',
                    'format' => 'image',
                ],
                'title',
                'description',
                'content:html',
            ],
        ]) ?>
    </div>
</div>
