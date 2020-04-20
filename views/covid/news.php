<?php
/** @var \yii\web\View $this */
/** @var \app\modules\admin\models\News[] $news */
/** @var array $covidData */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\CovidNewsAsset;
use app\components\widgets\covid19\Covid19;

CovidNewsAsset::register($this);

$this->title = Yii::t('app', 'COVID-19') . ' | ' . Yii::t('app', 'News');
$pageTitle = Yii::t('app', 'COVID-19');
$this->params['breadcrumbs'][] = $pageTitle;
?>
<div class="row covid-news-page">
    <div class="col s12">
        <h1><?= Html::encode($pageTitle)?></h1>

        <?php if ($news): ?>
            <div class="row">
                <div class="col s12">
                    <div class="row grid">
                        <?php if ($covidData):?>
                            <div class="stamp col s12 m6 l4 xl3">
                                <?= Covid19::widget(['covidData' => $covidData]) ?>
                            </div>
                        <?php endif; ?>
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
            <div class="card-panel s8 m6 l6">
                <p><?=Yii::t('app', 'News not found')?></p>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="row covid-map">
    <div class="col s12">
        <div class="card-panel">
            <div class="card-title">
                <h5>COVID-19 интерактив харитаси</h5>
            </div>
            <div class="card-content">
                <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0" title="2019-nCoV" src="https://gisanddata.maps.arcgis.com/apps/Embed/index.html?webmap=14aa9e5660cf42b5b4b546dec6ceec7c&extent=77.3846,11.535,163.5174,52.8632&zoom=true&previewImage=false&scale=true&disable_scroll=true&theme=light"></iframe>
                манба: Johns Hopkins Center for Systems Science and Engineering
            </div>
        </div>
    </div>
</div>
