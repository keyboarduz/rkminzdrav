<?php
/* @var $this \yii\web\View */
/* @var $leaderships \app\modules\admin\models\Leadership[] */

use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\models\form\UploadForm;

$this->title = Yii::t('app', 'Leadership');
$this->params['breadcrumbs'][] = [ 'label' => Yii::t('app', 'Ministry')];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<h1><?= Html::encode($this->title) ?></h1>

<div class="row">
    <div class="col-xs-12 col-md-9">
        <?php if ($leaderships): ?>
            <div class="panel">
                <div class="panel-body">
                    <?php
                    $numItems = count($leaderships);
                    $i = 0;
                    ?>
                    <?php foreach ($leaderships as $leadership): ?>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 lead-img">
                                <?= Html::img(Yii::getAlias('@web/uploads/images') . UploadForm::getMd5FilePath($leadership->photo), ['class' => 'img-responsive img-thumbnail']); ?>
                            </div>
                            <div class="col-md-8 col-xs-12 leadership">
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
                        <?php if(++$i !== $numItems): ?>
                            <div class="row">
                                <hr>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="well">
                <?= Yii::t('app', 'Section is in progress')?>
            </div>
        <?php endif; ?>

    </div>
    <div class="col-md-3 hidden-sm hidden-xs">
        <?= $this->render('_right-side') ?>
    </div>
</div>
