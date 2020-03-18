<?php
/**
 * Created by PhpStorm.
 * User: sparrow
 * Date: 12/11/19
 * Time: 6:30 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class MinistryPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/ministry-page.css',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];

}