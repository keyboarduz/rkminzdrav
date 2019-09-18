<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Foydalanuvchilar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box box-primary">
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

                'id',
                'username',
                 [
                     'attribute' => 'created_at',
                     'format' => ['date', 'php:d-m-Y  H:i'],
                     'filter' => false,
                 ],
                [
                    'attribute' => 'status',
                    'format' => 'html',
                    'filter' => [0 => "O'chirilgan", 10 => 'Aktiv'],
                    'value' => function($model, $key, $index, $column) {
                        return $model->status === 10 ? '<span class="label label-success">Aktiv</span>' : '<span class="label label-danger">O\'chirilgan</span>';
                    }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
