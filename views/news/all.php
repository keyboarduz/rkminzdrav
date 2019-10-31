<?php
/**
 * Created by PhpStorm.
 * User: Javlonbek
 * Date: 22.08.2019
 * Time: 15:04
 */

/**
 * @var $this \yii\web\View
 * @var $news \app\modules\admin\models\News[]
 * @var $pages \yii\data\Pagination
 */

use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;

$this->title = Yii::t('app', 'News');

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h3><?= Html::encode($this->title)?></h3>
</div>

<div class="row">
    <div class="col-sm-12">
        <?php if ($news): ?>
            <?php foreach ( $news as $oneNews ): ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="row">
                                    <!-- foto -->
                                    <div class="col-sm-4">
                                        <img src="<?=Url::to($oneNews->image_url)?>" class="img-responsive img-rounded">
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a href="<?= Url::to('/news/' . $oneNews->id) ?>"><h4><?= Html::encode($oneNews->title)?></h4></a>
                                                <p><?= $oneNews->description?></p>
                                            </div>
                                            <div class="col-sm-12">
                                                <p class="date pull-left">
                                                    <i class="fa fa-calendar"></i>
                                                    <?= date('d-m-Y', $oneNews->created_at) ?>
                                                </p>
                                                <a href="<?= Url::to(['/news/' . $oneNews->id]) ?>" class="btn btn-default pull-right"><?= Yii::t('app', 'More') ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="well">
                <p><?=Yii::t('app', 'News not found')?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col-sm-10 col-sm-offset-1">
        <?= LinkPager::widget(['pagination' => $pages])?>
    </div>
</div>


