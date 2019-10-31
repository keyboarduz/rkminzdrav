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

$this->title = $model->title;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'News'), 'url' => ['/news/all']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <p><i class="fa fa-calendar"> <?= date('d-m-Y', $model->created_at) ?></i></p>
    <h3><?= Html::encode($this->title)?></h3>
</div>

<div class="news-view">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel">
                <div class="panel-body">
                    <p>
                        <?= Html::img( '@web' . $model->image_url, ['class' => 'img-responsive img-rounded']) ?>
                    </p>
                    <span class="news-content">
                    <?= $model->content ?>
                </span>
                </div>
            </div>
        </div>
    </div>
</div>
