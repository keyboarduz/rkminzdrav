<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\modules\admin\models\form\UploadForm;
use app\modules\admin\models\Organization;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\admin\models\search\OrganizationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Organizations');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-index box box-primary">
    <div class="box-header with-border">
        <?= Html::a(Yii::t('app', 'Create Organization'), ['create'], ['class' => 'btn btn-success btn-flat']) ?>
    </div>
    <div class="box-body table-responsive no-padding">
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'layout' => "{items}\n{summary}\n{pager}",
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'name:ntext',
                [
                    'attribute' => 'photo',
                    'format' => ['image', ['width' => 100]],
                    'value' => function($model) {
                        return  Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($model->photo);
                    },
                    'filter' => false,
                ],
//                'leader',
//                'address:ntext',
                // 'phone',
                // 'email:ntext',
                // 'site',
                // 'category',
                [
                    'attribute' => 'category',
                    'format' => 'text',
                    'value' => function ($model) {
                        return Organization::getOrganizations()[$model->category];
                    },
                    'filter' => Organization::getOrganizations(),
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    </div>
</div>
