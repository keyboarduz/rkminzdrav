<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\admin\models\Document */
/* @var $fileModel \app\modules\admin\models\form\UploadForm */

$this->title = 'Hujjat yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Hujjatlar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="document-create">

    <?= $this->render('_form', [
        'model' => $model,
        'fileModel' => $fileModel,
    ]) ?>

</div>
