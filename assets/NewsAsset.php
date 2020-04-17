<?php
/**
 * Created by PhpStorm.
 * User: sparrow
 * Date: 12/8/19
 * Time: 5:21 PM
 */

namespace app\assets;


use app\assets\package\MasonryAsset;
use yii\web\AssetBundle;

class NewsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/news-page.css',
    ];

    public $js = [
        'js/news-page.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
        MasonryAsset::class,
    ];
}