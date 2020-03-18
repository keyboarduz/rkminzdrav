<?php

/* @var $this yii\web\View */
/* @var $news \app\modules\admin\models\News[] */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::$app->params['organization.name'];
?>
<div class="home-page">
    <div class="row">
        <!-- Yangiliklar -->
        <div class="col s12 m12 l8 news-cards">
            <h1><?= Yii::t('app', 'News') ?></h1>
            <div class="row">
                <?php if ( $news ): ?>
                    <?php foreach ($news as $oneNews): ?>
                    <div class="col m12">
                        <div class="card horizontal hoverable">
                            <div class="card-image">
                                <img src="<?=Url::to($oneNews->image_url)?>" class="">
                            </div>
                            <div class="card-stacked">
                                <div class="card-content">
                                    <span class="card-title">
                                        <a href="<?= Url::to('/news/' . $oneNews->id) ?>"><?= Html::encode($oneNews->title)?></a>
                                    </span>
                                    <p><?= $oneNews->description?></p>
                                    <a href="<?= Url::to('/news/' . $oneNews->id) ?>" class="btn btn-small light-blue pull-right"><?= Yii::t('app', 'More') ?></a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col m4">
                        <div class="well">
                            <?= Yii::t('app', 'News not found') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- foydali ma'lumotlar  -->
        <div class="col s12 m5 l4 useful-sites">
            <h1><?= Yii::t('app', 'Useful sites') ?></h1>
            <div class="card">
                <div class="card-body">
                    <div class="u-s-item">
                        <div class="u-s-img">
                            <img src="<?= Url::to('@web/images/my.gov.uz.png') ?>" class="responsive-img" alt="my.gov.uz" width="50">
                        </div>
                        <div class="u-s-action">
                            <a href="<?= Url::to('https://my.gov.uz') ?>">
                                Ягона интерактив давлат хизматлари портали
                            </a>
                        </div>
                    </div>
                    <div class="u-s-item">
                        <div class="u-s-img">
                            <img src="<?= Url::to('@web/images/president.png') ?>" class="responsive-img" alt="my.gov.uz">
                        </div>
                        <div class="u-s-action">
                            <a href="<?= Url::to('https://president.uz') ?>">
                                Ўзбекистон Республикаси Президенти веб сайти
                            </a>
                        </div>
                    </div>
                    <div class="u-s-item">
                        <div class="u-s-img">
                            <img src="<?= Url::to('@web/images/ochiq_mal_por.png') ?>" class="responsive-img" alt="my.gov.uz">
                        </div>
                        <div class="u-s-action">
                            <a href="<?= Url::to('https://data.gov.uz/uz') ?>">
                                Ўзбекистон Республикаси очиқ маълумотлар портали
                            </a>
                        </div>
                    </div>
                    <div class="u-s-item">
                        <div class="u-s-img">
                            <img src="<?= Url::to('@web/images/harakatlar_strategiyasi.png') ?>" class="responsive-img" alt="my.gov.uz">
                        </div>
                        <div class="u-s-action">
                            <a href="<?= Url::to('https://strategy.gov.uz/uz') ?>">
                                Ҳаракатлар стратегияси
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-content">
                    <div class="telegram-container">
                        <div class="telegram-image">
                            <span style="font-size: 3em; color: rgba(52,171,220,1);">
                                <i class="fa fa-telegram"></i>
                            </span>
                        </div>
                        <div class="telegram-title">
                            <?= Html::a(
                                Yii::t('app', 'Follow us through our channel in Telegram'),
                                'https://t.me/qrdssm',
                                ['target' => '_blank']
                            )?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
