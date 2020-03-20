<?php
use yii\helpers\Html;
use app\modules\admin\assets\AdminLoginAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AdminLoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->registerJsVar('site_key', Yii::$app->params['site_key']) ?>
    <?php $this->registerJsVar('google_recaptcha_action', '/admin/default/login') ?>
    <?php $this->head() ?>
</head>
<body class="login-page">

<?php $this->beginBody() ?>

    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
