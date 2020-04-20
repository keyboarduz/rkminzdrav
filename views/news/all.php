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
use app\assets\NewsAsset;

NewsAsset::register($this);

$this->title = Yii::t('app', 'News');

$this->params['breadcrumbs'][] = $this->title;
?>

<div class="row news-page">
    <div class="col s12">
        <h1><?= Html::encode($this->title)?></h1>

        <?php if ($news): ?>
            <div class="row">
                <div class="col s12">
                    <div class="row grid">
                        <div class="grid-sizer col s12 m6 l4 xl3"></div>
                        <?php foreach ( $news as $oneNews ): ?>
                            <div class="grid-item col s12 m6 l4 xl3">
                                <div class="card hoverable">
                                    <div class="card-image">
                                        <img src="<?=Url::to($oneNews->image_url)?>" class="">
                                        <a href="<?= Url::to('/news/' . $oneNews->id) ?>" class="btn-floating btn-large halfway-fab light-blue"><i class="material-icons">visibility</i></a>
                                    </div>
                                    <div class="card-content">
                                        <span class="blue-grey-text text-lighten-2" style="font-size: 13px"><i class="material-icons tiny">date_range</i> <?= date('d.m.Y', $oneNews->created_at) ?></span>
                                        <span class="card-title">
                                            <a href="<?= Url::to('/news/' . $oneNews->id) ?>" class="black-text"><?= Html::encode($oneNews->title)?></a>
                                        </span>
                                        <p><?= $oneNews->description?></p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="well">
                <p><?=Yii::t('app', 'News not found')?></p>
            </div>
        <?php endif; ?>
    </div>
</div>

<div class="row">
    <div class="col s12 m12">
        <?= LinkPager::widget([
            'pagination' => $pages,
            'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
            'prevPageLabel' => '<i class="fa fa-angle-left"></i>'
        ])?>
    </div>
</div>


