<?php


namespace app\assets\package;


use yii\web\AssetBundle;

class MasonryAsset extends AssetBundle
{
    public $baseUrl = '@web';
    public $basePath = '@webroot';

    public function init()
    {
        parent::init();

        $this->js[] = 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.' . (YII_ENV === 'prod' ? 'min.js'  : 'js');
    }
}