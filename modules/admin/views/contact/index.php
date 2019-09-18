<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\Contact;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\ContactSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Contacts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="contact-index box box-primary">
    <div class="box-header with-border">
        <?php // echo Html::a('Create Contact', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => null,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                'name:ntext',
                //'email:email',
                'subject',
                //'body:ntext',
                [
                    'attribute' => 'created_at',
                    'format' => ['date', 'php: d-m-Y | H:i:s']
                ],
                [
                    'attribute' => 'status',
                    'format' => 'html',
                    'value' => function($model, $key, $index, $column) {

                        return $model->getStatusLabel($model->status);
                    }
                ],
                // 'updated_at',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {delete} {set-status-viewed}',
                    'buttons' => [
                        'set-status-viewed' => function($url, $model, $key) {
                            return $model->status === Contact::STATUS_NEW
                                ? Html::a(
                                    Html::tag('i', '', ['class' => 'fa fa-check-square-o text-success']),
                                    $url,
                                    [
                                        'class' => '',
                                        'data' => [
                                            'confirm' => 'Siz rostdan ham bu murojatni ko\'rib chiqdingizmi?',
                                            'method' => 'post',
                                        ]
                                    ]
                                )
                                : '';
                        },
                        'delete' => function($url, $model, $key) {
                            return $model->status !== Contact::STATUS_DELETED
                                ? Html::a(
                                    Html::tag('i', '', ['class' => 'fa fa-trash text-danger']),
                                    $url,
                                    [
                                        'class' => '',
                                        'data' => [
                                            'confirm' => 'Siz rostdan ham ushbu elementni o`chirmoqchimisiz?',
                                            'method' => 'post',
                                        ]
                                    ]
                                )
                                : '';
                        },
                        'view' => function($url, $model, $key) {
                            return $model->status !== Contact::STATUS_DELETED
                                ? Html::a(
                                    Html::tag('i', '', ['class' => 'fa fa-eye text-primary']),
                                    $url
                                )
                                : '';
                        },
                    ],
                    /*'visibleButtons' => [
                        'set-status-viewed' => function ($model, $key, $index) { return $model->status === \app\modules\admin\models\Contact::STATUS_NEW; }
                    ]*/
                ],
            ],
        ]); ?>
    </div>
</div>
