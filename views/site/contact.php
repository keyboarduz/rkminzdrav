<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\captcha\Captcha;
use app\assets\SiteContactAsset;
use yii\helpers\Url;

SiteContactAsset::register($this);

$this->title = Yii::t('app', 'Contact');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row site-contact-title">
    <div class="col s12">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
</div>
<div class="row">



    <div class="col s12 m6">
        <?php if ($model->hasErrors()): ?>
            <div class="col s12">
                <div class="card-panel pink accent-1">
                    <?php foreach ( $model->getFirstErrors() as $k=>$v): ?>
                    <?=$v?><br>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col s12">
            <div class="site-contact card-panel">

                <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                    <div class="alert alert-success">
                        <?= Yii::t('app', 'Thank you for contacting us. We will respond to you as soon as possible.') ?>
                    </div>

                <?php else: ?>

                    <form action="<?=Url::to(['/site/contact'])?>" method="post">

                        <input type="hidden" name="<?=Yii::$app->request->csrfParam?>" value="<?=Yii::$app->request->csrfToken?>">
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">

                        <div class="input-field">
                            <input id="<?=$model->formName()?>-name" type="text" name="<?=$model->formName()?>[name]">
                            <label for="<?=$model->formName()?>-name"><?=$model->getAttributeLabel('name')?></label>
                        </div>
                        <div class="input-field">
                            <input id="<?=$model->formName()?>-email" type="email" name="<?=$model->formName()?>[email]">
                            <label for="<?=$model->formName()?>-email"><?=$model->getAttributeLabel('email')?></label>
                        </div>
                        <div class="input-field">
                            <input id="<?=$model->formName()?>-subject" type="text" name="<?=$model->formName()?>[subject]">
                            <label for="<?=$model->formName()?>-subject"><?=$model->getAttributeLabel('subject')?></label>
                        </div>
                        <div class="input-field">
                            <textarea class="materialize-textarea" id="<?=$model->formName()?>-body" type="" name="<?=$model->formName()?>[body]"></textarea>
                            <label for="<?=$model->formName()?>-body"><?=$model->getAttributeLabel('body')?></label>
                        </div>

                        <?=Captcha::widget([
                            'model' => $model,
                            'attribute' => 'verifyCode',
                            'options' => [
                                'autocomplete' => 'off'
                            ]
                        ]);?>

                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('app', 'Submit'), ['class' => 'btn light-blue', 'name' => 'contact-button']) ?>
                        </div>

                    </form>

                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col s12 m6">
        <div class="card-panel">
            <div id="osm-map"></div>
        </div>
    </div>
</div>

