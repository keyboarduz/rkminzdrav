<?php
/**
 * Created by PhpStorm.
 * User: Javlonbek
 * Date: 22.08.2019
 * Time: 15:47
 */

/**
 * @var $this \yii\web\View
 * @var $model \app\modules\admin\models\News
 */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\NewsAsset;

NewsAsset::register($this);

$this->title = $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['/news/all']];
$this->params['breadcrumbs'][] = $model->id;
?>

<div class="news-view">
    <div class="row">
        <div class="col s12 m12">
            <h1 class="news-title"><?= Html::encode($this->title)?></h1>
            <p><i class="material-icons">date_range</i> <?= date('d-m-Y', $model->created_at) ?></p>
            <div class="card-panel">
                <div class="center">
                    <?= Html::img( '@web' . $model->image_url, ['class' => 'responsive-img']) ?>
                </div>
                <span class="news-content">
                    <?= $model->content ?>
                </span>
            </div>
        </div>
    </div>
</div>
