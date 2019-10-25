<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\form\UploadForm;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\LeadershipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rahbariyat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leadership-index box box-primary">
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
                'position',
                [
                    'attribute' => 'photo',
                    'label' => 'Rasm',
                    'format' => ['image', ['height' => 50]],
                    'value' => function ($model) {
                        return Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($model->photo);
                    },
                    'filter' => false,
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
