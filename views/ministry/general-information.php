<?php
/* @var $this yii\web\View */
/* @var $generalInformation \app\modules\admin\models\GeneralInformation */

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\helpers\Url;
use app\assets\MinistryPageAsset;

MinistryPageAsset::register($this);

$this->title = Yii::t('app', 'General information');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ministry')];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<div class="row general-information-title">
    <div class="col s12">
        <h1><?=Html::encode($this->title)?></h1>
    </div>
</div>

<div class="row general-information">
    <div class="col s12 m9">
        <?php if ($generalInformation): ?>
            <div class="card">
                <div class="card-content">
                    <?= $generalInformation->content ?>
                </div>
            </div>
        <?php else: ?>
            <div class="card-panel">
                <?= Yii::t('app', 'Section is in progress')?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col m3 hide-on-small-only">
        <?= $this->render('_right-side'); ?>
    </div>
</div>