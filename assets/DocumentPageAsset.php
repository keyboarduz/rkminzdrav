<?php
/**
 * Created by PhpStorm.
 * User: sparrow
 * Date: 12/8/19
 * Time: 5:32 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class DocumentPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/document-page.css',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}