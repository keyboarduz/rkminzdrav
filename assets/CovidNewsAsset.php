<?php


namespace app\assets;


use app\assets\package\MasonryAsset;
use yii\web\AssetBundle;

class CovidNewsAsset extends AssetBundle
{
    public $baseUrl = '@web';
    public $basePath = '@webroot';

    public $css = [
        'css/covid-news.css',
    ];

    public $js = [
        'js/covid-news-page.js'
    ];

    public $depends = [
        AppAsset::class,
        MasonryAsset::class,
    ];
}