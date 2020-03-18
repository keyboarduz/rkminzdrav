<?php

namespace app\assets;

use yii\web\AssetBundle;

class MaterializeAsset extends AssetBundle {
    public $baseUrl = '@web';
    public $basePath = '@webroot';

    public $css = [
        'css/materialize.css',
    ];

    public $js = [
        'js/materialize.js',
    ];
}