<?php
/* @var $this \yii\web\View */
/* @var $documents \app\modules\admin\models\Document[] */
/* @var $pages \yii\data\Pagination */

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\admin\models\form\UploadForm;
use app\modules\admin\models\Document;

$this->title = Yii::t('app', 'Documents');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['/document/all']];

if ($this->context->action->id === 'type') {
    $this->params['breadcrumbs'][] = ['label' => Document::getTypes()[Yii::$app->request->get('id')]];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Барчаси'];
}
?>

<h1><?=Html::encode($this->title)?></h1>

<div class="row">
    <div class="col-xs-12 col-md-8">
        <?php if ($documents): ?>
            <div class="panel document">
                <div class="panel-body">
                    <?php
                    $numItems = count($documents);
                    $i = 0;
                    ?>
                    <?php foreach ($documents as $document): ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <?= Html::a(
                                $document->name,
                                "https://docs.google.com/gview?url=" . Url::to(['/'], true) . Yii::getAlias('@web/uploads/documents') . UploadForm::getMd5FilePath($document->file),
                                ['target' => '_blank', 'alt' => "Ko'rish", 'data-toggle'=>"tooltip", 'title'=>"Ҳужжатни кўриш", 'class' => "view-link"]
                                )?>
                            </div>
                        </div>
                        <div class="row">
                            <?php if ($document->date_of_admission): ?>
                                <div class="col-xs-12">
                                    <strong><?= Yii::t('app', 'Adoption date')?>:</strong>
                                    <?= Html::encode($document->date_of_admission)?>
                                </div>
                            <?php endif; ?>
                            <?php if ($document->document_number): ?>
                                <div class="col-xs-12">
                                    <strong><?= Yii::t('app', 'Document number')?>:</strong>
                                    <?= Html::encode($document->document_number)?>
                                </div>
                            <?php endif; ?>
                            <?php if ($document->type): ?>
                                <div class="col-xs-12">
                                    <strong><?= Yii::t('app', 'Document type')?>:</strong>
                                    <?= Html::encode(Document::getTypes()[$document->type])?>
                                </div>
                            <?php endif; ?>
                            <?php if ($document->file): ?>
                                <div class="col-xs-12">

                                    <?= Html::a(
                                        '<i class="fa fa-download" aria-hidden="true"></i>' . ' ' .Yii::t('app', 'Download'),
                                        Url::to(Yii::getAlias('@web/uploads/documents') . UploadForm::getMd5FilePath($document->file)),
                                        ['class' => 'btn btn-default btn-sm']
                                    )?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if(++$i !== $numItems): ?>
                            <div class="row">
                                <hr>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <?php if ($pages->pageCount > 1): ?>
                    <div class="panel-footer">
                        <?= \yii\widgets\LinkPager::widget([
                            'pagination' => $pages,
                            'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
                            'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>'
                        ]); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="well">
                <?= Yii::t('app', 'No data found')?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-4 hidden-sm hidden-xs">
        <?= $this->render('_right-side') ?>
    </div>
</div>