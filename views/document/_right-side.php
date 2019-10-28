<?php
/* @var $this \yii\web\View */

use yii\helpers\Url;
use app\modules\admin\models\Document;

$documentTypes = Document::getTypes();

$countTypes = Document::find()
    ->select('type, COUNT(*) AS cnt')
    ->groupBy('type')
    ->indexBy('type')
    ->asArray()
    ->all();
?>

<?php
//var_dump(Yii::$app->request->getUrl()); die;
?>

<div class="list-group">
    <?php foreach ($documentTypes as $k => $v): ?>
        <?php if ($k == isset($countTypes[$k])): ?>
            <a href="<?= Url::to(["/document/type/{$k}"]) ?>" class="list-group-item <?= "/document/type/{$k}" === Yii::$app->request->getUrl() ? 'active' : ''?>"><?= $v ?></a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>