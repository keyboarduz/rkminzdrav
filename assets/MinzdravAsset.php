<?php
/**
 * Created by PhpStorm.
 * User: Javlonbek
 * Date: 12.08.2019
 * Time: 12:37
 */

namespace app\assets;

use yii\web\AssetBundle;


class MinzdravAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900&display=swap&subset=cyrillic,cyrillic-ext',
        'css/site.css',
    ];

    public $js = [
        'js/openmap.js'
    ];

    public $depends = [
        LeafletAsset::class,
        'app\assets\FontAwesomeAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];

}