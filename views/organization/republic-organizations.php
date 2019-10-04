<?php
/* @var $this yii\web\View */
/* @var $models \app\modules\admin\models\Organization[] */
/* @var $pages \yii\data\Pagination */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\modules\admin\models\form\UploadForm;

$this->title = Yii::t('app','Republic organizations');

$this->params['breadcrumbs'][] = ['label' => $this->title]
?>
<h3><?= Html::encode($this->title)?></h3>

<?php foreach ($models as $model): ?>
    <div class="row organization">
        <div class="col-md-8">
            <div class="panel">
                <div class="row organization-name">
                    <div class="col-md-12">
                        <h4><i class="fa fa-hospital-o"></i> <?=$model->name?></h4></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?=Html::img(Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($model->photo), [
                            'class' => 'img-responsive center-block img-rounded',
                        ]) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 organization-data">
                        <dl class="dl-horizontal">
                            <dt>Раҳбари:</dt>
                            <dd><?= $model->leader;?></dd>
                            <dt>Манзил:</dt>
                            <dd><?= $model->address;?></dd>
                            <dt>Телефон:</dt>
                            <dd><?= $model->phone;?></dd>

                            <?php if ($model->email !== null): ?>
                                <dt>E-mail:</dt>
                                <dd><?= Html::a($model->email, 'mailto:' . $model->email);?></dd>
                            <?php endif; ?>

                            <?php if ($model->site !== null): ?>
                                <dt>Сайт:</dt>
                                <dd><?= Html::a($model->site, 'http://' . $model->site, ['target' => '_blank']);?></dd>
                            <?php endif; ?>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<?= LinkPager::widget([
    'pagination' => $pages,
    'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
    'prevPageLabel' => '<i class="fa fa-angle-left"></i>'
]); ?>