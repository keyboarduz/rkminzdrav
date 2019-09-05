<?php

/* @var $this yii\web\View */
/* @var $news \app\modules\admin\models\News[] */

use yii\helpers\Url;
use yii\helpers\Html;

$this->title = Yii::$app->params['organization.name'];
?>
<div class="news">
    <div class="row">
        <div class="col-sm-8">
            <!-- Yangiliklar -->
            <h4><?= Yii::t('app', 'News') ?></h4>
            <div class="row">
                <?php if ( $news ): ?>
                    <?php foreach ($news as $oneNews): ?>
                    <div class="col-sm-12">
                        <div class="panel">
                            <div class="row">
                                <!-- foto -->
                                <div class="col-sm-4">
                                    <img src="<?=Url::to($oneNews->image_url)?>" class="img-responsive">
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="<?= Url::to('/news/' . $oneNews->id) ?>"><h4><?= Html::encode($oneNews->title)?></h4></a>
                                            <p><?= $oneNews->description?></p>
                                        </div>
                                        <div class="col-sm-12">
                                            <p class="date pull-left">
                                                <i class="far fa-calendar-alt"></i>

                                                <?= date('d-m-Y', $oneNews->created_at) ?>
                                            </p>
                                            <a href="<?= Url::to('/news/' . $oneNews->id) ?>" class="btn btn-default pull-right"><?= Yii::t('app', 'More') ?></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-sm-12">
                        <div class="well">
                            <?= Yii::t('app', 'News not found') ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- foydali ma'lumotlar  -->
        <div class="col-sm-4">
            <h4><?= Yii::t('app', 'Useful sites') ?></h4>
            <div class="panel useful-sites">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-5">
                                <img src="<?= Url::to('@web/images/my.gov.uz.png') ?>" class="img-responsive" alt="my.gov.uz" width="50">
                            </div>
                            <div class="col-sm-7">
                                <a href="<?= Url::to('https://my.gov.uz') ?>">
                                    Ягона интерактив давлат хизматлари портали
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-5">
                                <img src="<?= Url::to('@web/images/president.png') ?>" class="img-responsive" alt="my.gov.uz">
                            </div>
                            <div class="col-sm-7">
                                <a href="<?= Url::to('https://president.uz') ?>">
                                    Ўзбекистон Республикаси Президенти веб сайти
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-5">
                                <img src="<?= Url::to('@web/images/ochiq_mal_por.png') ?>" class="img-responsive" alt="my.gov.uz">
                            </div>
                            <div class="col-sm-7">
                                <a href="<?= Url::to('https://data.gov.uz/uz') ?>">
                                    Ўзбекистон Республикаси очиқ маълумотлар портали
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-5">
                                <img src="<?= Url::to('@web/images/harakatlar_strategiyasi.png') ?>" class="img-responsive" alt="my.gov.uz">
                            </div>
                            <div class="col-sm-7">
                                <a href="<?= Url::to('https://strategy.gov.uz/uz') ?>">
                                    Ҳаракатлар стратегияси
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
