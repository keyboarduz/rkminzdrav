<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\materialize\Breadcrumbs;
use app\assets\AppAsset;
use app\modules\admin\models\Document;

AppAsset::register($this);

//generate Document menu
$countDocumentCategories = Document::getCountCategories();
$documentLabels = Document::getCategories();
$documentMenu = [];

$documentMenuHtml = '';
foreach ($countDocumentCategories as $k => $v) {
    $documentMenu[] = [
        'label' => $documentLabels[$k],
        'url' => '/document/category/' . $k,
    ];

    $documentMenuHtml .= '<li>';
    $documentMenuHtml .= '<a href="' . Url::to(['/document/category/'.$k]) . '">';
    $documentMenuHtml .= $documentLabels[$k] . '</a>';
    $documentMenuHtml .= '</li>';
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<header>
    <div class="top-header fluid-container hide-on-small-only">
        <div class="row">
            <div class="col m9">
                <a href="<?= Url::to(['/']) ?>" class="logo-link">
                    <img src="<?= Url::to('@web/images/logo.png') ?>" alt="logo" class="logo-image" height="108" width="108">
                    <div class="logo-text">
                            Қорақалпоғистон Республикаси
                            <br>
                            Соғлиқни Сақлаш Вазирлиги
                    </div>
                </a>
            </div>
            <div class="col m3">
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

    <!-- Navbar -->
    <nav class="light-blue primary-nav">
        <div class="nav-wrapper">
            <a href="<?=Url::to(['/'])?>" class="brand-logo hide-on-med-and-up">ҚРССВ</a>
            <ul class="left hide-on-med-and-down">
                <li><a href="<?= Url::to(['/']) ?>"><?=Yii::t('app', 'Home')?></a></li>
                <li><a href="<?= Url::to(['/news/all']) ?>"><?=Yii::t('app', 'News')?></a></li>
                <li>
                    <a href="<?= Url::to(['/document']) ?>" class="dropdown-trigger" data-target="dropdownDocument">
                        <?=Yii::t('app', 'Documents')?>
                    </a>
                    <ul id="dropdownDocument" class="dropdown-content light-blue">
                        <?=$documentMenuHtml?>
                    </ul>
                </li>
                <li>
                    <a href="<?= Url::to(['/organization/republic-organizations']) ?>" class="dropdown-trigger" data-target="dropdownOrganization">
                        <?=Yii::t('app', 'Organizations')?>
                    </a>
                    <ul id="dropdownOrganization" class="dropdown-content light-blue">
                        <li><a href="<?=Url::to(['/organization/republic-organizations'])?>"><?=Yii::t('app', 'Republic organizations')?></a></li>
                        <li><a href="<?= Url::to(['/organization/district-medical-associations']) ?>"><?=Yii::t('app', 'District medical associations')?></a></li>
                    </ul>
                </li>
                <li><a href="<?= Url::to(['/']) ?>"><?=Yii::t('app', 'Announcement')?></a></li>
                <li>
                    <a href="<?= Url::to(['/ministry']) ?>" class="dropdown-trigger" data-target="dropdownMinistry">
                        <?=Yii::t('app', 'Ministry')?>
                    </a>
                    <ul id="dropdownMinistry" class="dropdown-content light-blue">
                        <li><a href="<?=Url::to(['/ministry/general-information'])?>"><?=Yii::t('app', 'General information')?></a></li>
                        <li><a href="<?=Url::to(['/ministry/leadership'])?>"><?=Yii::t('app', 'Leadership')?></a></li>
                    </ul>
                </li>
                <li><a href="<?= Url::to(['/site/contact']) ?>"><?=Yii::t('app', 'Contact')?></a></li>
            </ul>

            <!-- Mobile nav -->
            <ul id="nav-mobile" class="sidenav light-blue lighten-2 white-text">
                <li><a href="<?= Url::to(['/']) ?>"><?=Yii::t('app', 'Home')?></a></li>
                <li><a href="<?= Url::to(['/news/all']) ?>"><?=Yii::t('app', 'News')?></a></li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header"><?=Yii::t('app', 'Documents')?></a>
                            <div class="collapsible-body">
                                <ul>
                                    <?=$documentMenuHtml?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header"><?=Yii::t('app', 'Organizations')?></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="<?=Url::to(['/organization/republic-organizations'])?>"><?=Yii::t('app', 'Republic organizations')?></a></li>
                                    <li><a href="<?= Url::to(['/organization/district-medical-associations']) ?>"><?=Yii::t('app', 'District medical associations')?></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li><a href="<?= Url::to(['/']) ?>"><?=Yii::t('app', 'Announcement')?></a></li>
                <li class="no-padding">
                    <ul class="collapsible collapsible-accordion">
                        <li>
                            <a class="collapsible-header"><?=Yii::t('app', 'Ministry')?></a>
                            <div class="collapsible-body">
                                <ul>
                                    <li><a href="<?=Url::to(['/ministry/general-information'])?>"><?=Yii::t('app', 'General information')?></a></li>
                                    <li><a href="<?=Url::to(['/ministry/leadership'])?>"><?=Yii::t('app', 'Leadership')?></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </li>
                <li><a href="<?= Url::to(['/site/contact']) ?>"><?=Yii::t('app', 'Contact')?></a></li>
            </ul>
            <!-- nav Mobile trigger -->
            <a href="#" data-target="nav-mobile" class="sidenav-trigger right">
                <i class="fa fa-minus fa-2x"></i>
                <i class="fa fa-minus fa-2x"></i>
                <i class="fa fa-minus fa-2x"></i>
            </a>
        </div>
    </nav>
</header>

<div class="fluid-container main">
    <div class="breadcrumb-nav">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            'homeLink' => ['label' => Yii::t('app', 'Main'), 'url' => ['/']],
        ]) ?>
    </div>
    <?= $content ?>
</div>

<footer class="page-footer">
    <div class="container hide">
        <div class="row">
            <div class="col m5 offset-m5">
                <div id="osm-map"></div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
                <p class=""><a href="/">Қорақалпоғистон Республикаси Соғлиқни Сақлаш Вазирлиги</a>  <?= date('Y') ?></p>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
