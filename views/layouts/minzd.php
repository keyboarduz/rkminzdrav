<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\web\View;

use app\assets\MinzdravAsset;
use yii\helpers\Url;

//$this->registerJsFile('https://kit.fontawesome.com/bfebc64ecd.js', ['position' => View::POS_HEAD]);

MinzdravAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header>
    <div class="box hidden-xs">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <a href="<?= Url::to(['/']) ?>" class="logo">
                        <img src="<?= Url::to('@web/images/logo.png') ?>" alt="logo" class="" height="108" width="108">
                        <span class="text-uppercase">
                                Қорақалпоғистон Республикаси
                                <br>
                                Соғлиқни Сақлаш Вазирлиги
                        </span>
                    </a>
                </div>
                <div class="col-sm-3 hidden-sm">
                    <p class="">
                        Ишонч телефони:
                        <br>
                        <span style="color: #1725d0;">
                            <i class="fa fa-phone-square" style="font-size: 18px; color: #0806ff;"></i>
                            +998 (61) 226-00-48
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php
    NavBar::begin([
        'options' => [
            'class' => 'rkmz-navbar',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'dropDownCaret' => '',
        'items' => [
            ['label' => Yii::t('app', 'Home'), 'url' => ['/']],
            ['label' => Yii::t('app', 'News'), 'url' => ['/news/all']],
            ['label' => Yii::t('app', 'Documents'), 'url' => ['/site/index'], 'items' => [
                ['label' => 'first', 'url' => ['/']],
                ['label' => 'second'],
            ]],
            ['label' => Yii::t('app', 'Organizations'), 'url' => ['/site/index'], 'items' => [
                ['label' => Yii::t('app', 'Republic organizations'), 'url' => ['/organization/republic-organizations']],
                ['label' => Yii::t('app', 'District medical associations'), 'url' => ['/organization/district-medical-associations']],
            ]],
            ['label' => Yii::t('app', 'Announcement'), 'url' => ['/site/about']],
            ['label' => Yii::t('app', 'Ministry'), 'url' => ['/site/index'], 'items' => [
                ['label' => Yii::t('app', 'General information'), 'url' => ['/ministry/general-information']],
                ['label' => Yii::t('app', 'Leadership'), 'url' => ['/ministry/leadership']],
            ]],
            ['label' => Yii::t('app', 'Contact'), 'url' => ['/site/contact']],
        ],
    ]);
    NavBar::end();
    ?>
</header>

<div class="wrap">

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-sm-offset-7 col-sm-5">
                <div id="osm-map"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <p class="pull-left">Қорақалпоғистон Республикаси Соғлиқни Сақлаш Вазирлиги  <?= date('Y') ?>  <a href="/">rkmizdrav.uz</a></p>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
