<?php
/* @var $this \yii\web\View */
/* @var $documents \app\modules\admin\models\Document[] */
/* @var $pages \yii\data\Pagination */

use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\admin\models\form\UploadForm;
use app\modules\admin\models\Document;
use app\assets\DocumentPageAsset;

DocumentPageAsset::register($this);

$this->title = Yii::t('app', 'Documents');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Documents'), 'url' => ['/document/all']];

if ($this->context->action->id === 'category') {
    $this->params['breadcrumbs'][] = ['label' => Document::getCategories()[Yii::$app->request->get('id')]];
} else {
    $this->params['breadcrumbs'][] = ['label' => 'Барчаси'];
}
?>

<div class="row document-page">
    <div class="col s12 m8">
        <?php if ($documents): ?>
            <h1><?=Html::encode($this->title)?></h1>
            <div class="card-panel z-depth-2 document-card">
                <?php
                $numItems = count($documents);
                $i = 0;
                ?>
                <?php foreach ($documents as $document): ?>
                    <div class="row">
                        <div class="col s12">
                            <?= Html::a(
                            $document->name,
                            "https://docs.google.com/gview?url=" . Url::to(['/'], true) . Yii::getAlias('@web/uploads/documents') . UploadForm::getMd5FilePath($document->file),
                            ['target' => '_blank', 'alt' => "Ko'rish", 'data-toggle'=>"tooltip", 'title'=>"Ҳужжатни кўриш", 'class' => "view-link"]
                            )?>
                        </div>
                    </div>
                        <div class="row">
                            <?php if ($document->date_of_admission): ?>
                                <div class="col s12">
                                    <strong><?= Yii::t('app', 'Adoption date')?>:</strong>
                                    <?= Html::encode($document->date_of_admission)?>
                                </div>
                            <?php endif; ?>
                            <?php if ($document->document_number): ?>
                                <div class="col s12">
                                    <strong><?= Yii::t('app', 'Document number')?>:</strong>
                                    <?= Html::encode($document->document_number)?>
                                </div>
                            <?php endif; ?>
                            <?php if ($document->type_document): ?>
                                <div class="col s12">
                                    <strong><?= Yii::t('app', 'Document type')?>:</strong>
                                    <?= Html::encode(Document::getTypes()[$document->type_document])?>
                                </div>
                            <?php endif; ?>
                            <?php if ($document->file): ?>
                                <div class="col s12">
                                    <?= Html::a(
                                        '<i class="fa fa-download" aria-hidden="true"></i>' . ' ' .Yii::t('app', 'Download'),
                                        Url::to(Yii::getAlias('@web/uploads/documents') . UploadForm::getMd5FilePath($document->file)),
                                        ['class' => 'btn btn-small light-blue btn-download']
                                    )?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if(++$i !== $numItems): ?>
                            <div class="row">
                                <div class="divider"></div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="well">
                <?= Yii::t('app', 'No data found')?>
            </div>
        <?php endif; ?>
    </div>
    <div class="col m4 hide-on-small-only document-category">
        <?= $this->render('_right-side') ?>
    </div>
    <div class="col s12">
        <?= \yii\widgets\LinkPager::widget([
            'pagination' => $pages,
            'nextPageLabel' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            'prevPageLabel' => '<i class="fa fa-angle-left" aria-hidden="true"></i>'
        ]); ?>
    </div>
</div>