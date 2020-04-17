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
                    <div class="news-grid">
                        <?php foreach ( $news as $oneNews ): ?>
                            <div class="news-grid-item">
                                <div class="card hoverable news-grid-item-card">
                                    <div class="card-image">
                                        <img src="<?=Url::to($oneNews->image_url)?>" class="">
                                        <a href="<?= Url::to('/news/' . $oneNews->id) ?>" class="btn-floating btn-large halfway-fab light-blue"><i class="fa fa-eye"></i></a>
                                    </div>
                                    <div class="card-content">
                                    <span class="card-title">
                                        <a href="<?= Url::to('/news/' . $oneNews->id) ?>"><?= Html::encode($oneNews->title)?></a>
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


