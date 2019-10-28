<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\Document;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\DocumentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Hujjatlar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a('Yaratish', ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name',
                [
                    'attribute' => 'date_of_admission',
                    'filter' => false,
                ],
                [
                    'attribute' => 'type',
                    'filter' => Document::getTypes(),
                    'value' => function($model) {
                        return Document::getTypes()[$model->type];
                    }
                ],
                // 'description:ntext',
                // 'content:ntext',
                // 'document_number',
                // 'created_at',
                // 'updated_at',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
