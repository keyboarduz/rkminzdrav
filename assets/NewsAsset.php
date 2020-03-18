<?php
/**
 * Created by PhpStorm.
 * User: sparrow
 * Date: 12/8/19
 * Time: 5:21 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class NewsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/news-page.css',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}