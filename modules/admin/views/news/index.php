<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'News';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Create News', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
//                ['class' => 'yii\grid\SerialColumn'],

                [
                    'label' => 'Muallif',
                    'attribute' => 'author_id',
                    'value' => 'author.username'
                ],
                [
                    'attribute' => 'category_id',
                    'value' => 'category.title',
                    'filter' => \app\modules\admin\models\Category::find()->select(['title', 'id'])->indexBy('id')->column(),
                ],
                'title',
                [
                    'attribute' => 'created_at',
                    'format' => 'datetime',
                    'filter' => false,
                ],
                [
                    'attribute' => 'status',
                    'filter' => $searchModel->getStatuses(),
                    'format' => 'raw',
                    'value' => function ($model) {
                        return $model->status === 10 ?
                            '<span class="label label-success">Aktiv</span>'
                            : '<span class="label label-warning">Qoralama</span>';
                    }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
