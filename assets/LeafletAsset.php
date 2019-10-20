<?php
/**
 * Created by PhpStorm.
 * User: sparrow
 * Date: 10/16/19
 * Time: 10:56 PM
 */

namespace app\assets;


use yii\web\AssetBundle;
use yii\web\View;

class LeafletAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        "https://unpkg.com/leaflet@1.5.1/dist/leaflet.css",
    ];

    public $js = [
        "https://unpkg.com/leaflet@1.5.1/dist/leaflet.js",
    ];

    public $jsOptions = [
        'position' => View::POS_HEAD,
    ];

}