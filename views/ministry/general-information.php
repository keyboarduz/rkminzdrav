<?php
/* @var $this yii\web\View */
/* @var $generalInformation \app\modules\admin\models\GeneralInformation */

use yii\helpers\Html;
use yii\widgets\Menu;
use yii\helpers\Url;

$this->title = Yii::t('app', 'General information');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ministry')];
$this->params['breadcrumbs'][] = ['label' => $this->title];
?>
<h1><?=Html::encode($this->title)?></h1>

<div class="row">
    <div class="col-xs-12 col-md-9">
        <?php if ($generalInformation): ?>
            <div class="panel">
                <?= $generalInformation->content ?>
            </div>
        <?php else: ?>
            <div class="well">
                <?= Yii::t('app', 'Section is in progress')?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-3 hidden-sm hidden-xs">
        <?= $this->render('_right-side'); ?>
    </div>
</div>