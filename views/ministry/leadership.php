<?php
/* @var $this \yii\web\View */
/* @var $leaderships \app\modules\admin\models\Leadership[] */

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\models\form\UploadForm;
use app\assets\MinistryPageAsset;

MinistryPageAsset::register($this);

$this->title = Yii::t('app', 'Leadership');
$this->params['breadcrumbs'][] = [ 'label' => Yii::t('app', 'Ministry')];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="row leadership-page-title">
    <div class="col s12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
</div>

<div class="row leadership-page">
    <?php if ($leaderships): ?>

        <div class="col s12 m9">
        <?php foreach ($leaderships as $leadership): ?>
            <div class="card hoverable">
                <div class="row">
                    <div class="col s12 m4">
                        <figure class="lead-img">
                            <?= Html::img(
                                Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($leadership->photo),
                                ['class' => 'responsive-img']
                            ); ?>
                        </figure>
                    </div>
                    <div class="col s12 m8">
                        <div class="card-content leadership">
                            <div class="lead-position"><?= $leadership->position ?></div>
                            <div class="lead-name"><?= $leadership->name ?></div>
                            <div class="lead-contacts">
                                <strong><?=Yii::t('app', 'Contacts')?>:</strong>
                                <?php if ($leadership->phone): ?>
                                    <div class="lead-phone">
                                        <?=Yii::t('app', 'Phone')?>: <?= $leadership->phone ?>
                                    </div>
                                <?php endif; ?>

                                <?php if ($leadership->email): ?>
                                    <div class="lead-email">
                                        <?=Yii::t('app', 'Email')?>: <?= $leadership->email ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="lead-reception">
                                <?php if ($leadership->reception_days): ?>
                                    <strong><?=Yii::t('app', 'Reception days')?>:</strong>
                                    <div class="lead-reception-days">
                                        <?= $leadership->reception_days; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
        <div class="col m3 hide-on-small-only">
            <?= $this->render('_right-side') ?>
        </div>

    <?php else: ?>
        <div class="card-panel">
            <?= Yii::t('app', 'Section is in progress')?>
        </div>
    <?php endif; ?>
</div>
