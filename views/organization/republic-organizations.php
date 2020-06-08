<?php
/* @var $this yii\web\View */
/* @var $models \app\modules\admin\models\Organization[] */
/* @var $pages \yii\data\Pagination */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use app\modules\admin\models\form\UploadForm;
use app\assets\OrganizationAsset;

OrganizationAsset::register($this);

$this->title = Yii::t('app','Republic organizations');

$this->params['breadcrumbs'][] = ['label' => $this->title]
?>

<div class="row organization-page">
    <div class="col s12 m12 l8">
        <h1 class="page-title"><?= Html::encode($this->title)?></h1>
        <?php foreach ($models as $model): ?>
            <div class="card">
                <?php if ($model->photo): ?>
                    <figure>
                        <?=Html::img(Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($model->photo), [
                            'class' => 'responsive-img materialboxed',
                            'data-caption' => $model->name
                        ]) ?>
                    </figure>
                <?php endif; ?>
                <div class="card-content organization-data">
                    <div class="organization-name card-title">
                        <h2><i class="fa fa-hospital-o"></i> <?=$model->name?></h2>
                    </div>
                    <p>
                        <strong>Раҳбари:</strong>
                        <?= $model->leader;?>
                    </p>
                    <p>
                        <strong>Манзил:</strong>
                        <span><?= $model->address;?></span>
                    </p>
                    <p>
                        <strong>Телефон:</strong>
                        <span><?= $model->phone;?></span>
                    </p>
                    <?php if ($model->email !== null): ?>
                        <p>
                            <strong>E-mail:</strong>
                            <span><?= Html::a($model->email, 'mailto:' . $model->email);?></span>
                        </p>
                    <?php endif; ?>
                    <?php if ($model->site !== null): ?>
                        <p>
                            <strong>Сайт:</strong>
                            <span><?= Html::a($model->site, 'http://' . $model->site, ['target' => '_blank']);?></span>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <div class="row">
        <div class="col s10 offset-s2 m10 offset-m2">
            <?= LinkPager::widget([
                'pagination' => $pages,
                'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
                'prevPageLabel' => '<i class="fa fa-angle-left"></i>'
            ]); ?>
        </div>
    </div>
</div>