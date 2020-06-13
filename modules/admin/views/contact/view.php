<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Contact */

$this->title = 'FISH: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Qayta aloqa', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-view box box-primary">
    <div class="box-header">

        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-flat',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?php if ($model->status === $model::STATUS_NEW): ?>
            <?= Html::a('Ko\'rib chiqdim', ['set-status-viewed', 'id' => $model->id], [
                'class' => 'btn btn-success btn-flat',
                'data' => [
                    'confirm' => 'Siz rostdan ham bu murojatni ko\'rib chiqdingizmi?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name:ntext',
                'email:email',
                'phone',
                'subject',
                'body:ntext',
                [
                    'attribute' => 'status',
                    'format' => 'html',
                    'value' => function($model, $key) {

                        return $model->getStatusLabel($model->status);
                    }
                ],
                [
                    'attribute' => 'created_at',
                    'format' => ['date', 'php:d.m.Y | H:i:s']
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => ['date', 'php:d.m.Y | H:i:s']
                ],
            ],
        ]) ?>
    </div>
</div>
