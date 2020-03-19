<?php


namespace app\assets;

use Yii;
use yii\web\AssetBundle;

class GoogleRecaptchaV3Asset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public function init()
    {
        parent::init();
        $this->js[] = 'https://www.google.com/recaptcha/api.js?render=' . Yii::$app->params['site_key'];
        $this->js[] = 'js/grecaptcha.js';
    }
}