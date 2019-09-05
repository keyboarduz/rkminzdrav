<?php
/**
 * Created by PhpStorm.
 * User: Javlonbek
 * Date: 22.08.2019
 * Time: 0:38
 */

namespace app\assets;


use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@vendor/fortawesome/font-awesome';
    public $css = [
        'css/font-awesome.min.css',
    ];
}