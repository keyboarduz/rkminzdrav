<?php


namespace app\assets;


use yii\web\AssetBundle;

class CovidNewsAsset extends AssetBundle
{
    public $baseUrl = '@web';
    public $basePath = '@webroot';

    public $css = [
        'css/covid-news.css',
    ];

    public $depends = [
        AppAsset::class,
    ];
}