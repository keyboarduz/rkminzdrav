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

    <?php $this->registerJsVar('site_key', Yii::$app->params['site_key']); ?>
    <?php $this->registerJsVar('google_recaptcha_action', '/site/contact') ?>

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
                <li><a href="<?= Url::to(['/covid/news'])?>"><?=Yii::t('app', 'COVID-19')?></a></li>
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
                <li><a href="<?= Url::to(['/covid/news'])?>"><?=Yii::t('app', 'COVID-19')?></a></li>
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
            <a href="#" data-target="nav-mobile" class="sidenav-trigger">
                <i class="material-icons">menu</i>
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
            <div class="row">
                <div class="col s11">
                    <p class=""><a href="/">Қорақалпоғистон Республикаси Соғлиқни Сақлаш Вазирлиги</a>  <?= date('Y') ?></p>
                </div>
                <div class="col s1">
                    <!-- START WWW.UZ TOP-RATING -->
                    <SCRIPT language="javascript" type="text/javascript">
                        <!--
                        top_js="1.0";top_r="id=44587&r="+escape(document.referrer)+"&pg="+escape(window.location.href);document.cookie="smart_top=1; path=/"; top_r+="&c="+(document.cookie?"Y":"N")
                        //-->
                    </SCRIPT>
                    <SCRIPT language="javascript1.1" type="text/javascript">
                        <!--
                        top_js="1.1";top_r+="&j="+(navigator.javaEnabled()?"Y":"N")
                        //-->
                    </SCRIPT>
                    <SCRIPT language="javascript1.2" type="text/javascript">
                        <!--
                        top_js="1.2";top_r+="&wh="+screen.width+'x'+screen.height+"&px="+
                            (((navigator.appName.substring(0,3)=="Mic"))?screen.colorDepth:screen.pixelDepth)
                        //-->
                    </SCRIPT>
                    <SCRIPT language="javascript1.3" type="text/javascript">
                        <!--
                        top_js="1.3";
                        //-->
                    </SCRIPT>
                    <SCRIPT language="JavaScript" type="text/javascript">
                        <!--
                        top_rat="&col=F7AE00&t=ffffff&p=0E418F";top_r+="&js="+top_js+"";document.write('<a href="http://www.uz/ru/res/visitor/index?id=44587" target=_top><img src="https://cnt0.www.uz/counter/collect?'+top_r+top_rat+'" width=88 height=31 border=0 alt="Топ рейтинг www.uz"></a>')//-->
                    </SCRIPT><NOSCRIPT><A href="http://www.uz/ru/res/visitor/index?id=44587" target=_top><IMG height=31 src="https://cnt0.www.uz/counter/collect?id=44587&pg=http%3A//uzinfocom.uz&&col=F7AE00&amp;t=ffffff&amp;p=0E418F" width=88 border=0 alt="Топ рейтинг www.uz"></A></NOSCRIPT>
                    <!-- FINISH WWW.UZ TOP-RATING -->
                </div>
            </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
