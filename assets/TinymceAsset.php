<?php


namespace app\assets;


use Yii;
use yii\web\AssetBundle;

class TinymceAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public function init()
    {
        parent::init();
        $this->js[] = 'https://cdn.tiny.cloud/1/'.Yii::$app->params['tinyApiKey'].'/tinymce/5/tinymce.min.js';
    }
    
    public $jsOptions = [
        'referrerpolicy' => "origin",
    ];
}