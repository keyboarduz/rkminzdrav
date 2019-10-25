<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Leadership */
/* @var $imageModel \app\modules\admin\models\form\UploadForm */

$this->title = 'Yangi lavozim yaratish';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Leaderships'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="leadership-create">

    <?= $this->render('_form', [
        'model' => $model,
        'imageModel' => $imageModel
    ]) ?>

</div>
