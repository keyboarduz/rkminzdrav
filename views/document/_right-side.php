<?php
/* @var $this \yii\web\View */

use yii\helpers\Url;
use app\modules\admin\models\Document;

$documentCategories = Document::getCategories();

$countCategories = Document::find()
    ->select('category, COUNT(*) AS cnt')
    ->groupBy('category')
    ->indexBy('category')
    ->asArray()
    ->all();
?>

<?php
//var_dump(Yii::$app->request->getUrl()); die;
?>

<div class="list-group">
    <?php foreach ($documentCategories as $k => $v): ?>
        <?php if ($k == isset($countCategories[$k])): ?>
            <a href="<?= Url::to(["/document/category/{$k}"]) ?>" class="list-group-item <?= "/document/category/{$k}" === Yii::$app->request->getUrl() ? 'active' : ''?>"><?= $v ?></a>
        <?php endif; ?>
    <?php endforeach; ?>
</div>