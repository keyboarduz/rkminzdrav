<?php


namespace app\assets\package;


use yii\web\AssetBundle;

class ImagesLoadedAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public function init()
    {
        parent::init();

        // https://imagesloaded.desandro.com/
        $this->js[] = 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.' . (YII_ENV === 'prod' ? 'min.js'  : 'js');
    }
}