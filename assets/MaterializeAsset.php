<?php

namespace app\assets;

use yii\web\AssetBundle;

class MaterializeAsset extends AssetBundle {
    public $baseUrl = '@web';
    public $basePath = '@webroot';

    public function init()
    {
        parent::init();

        if (YII_ENV === 'prod') {
            $this->css[] = "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css";
            $this->js[] = "https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js";
        } else {
            $this->css[] = 'css/materialize.css';
            $this->js[] = 'js/materialize.js';
        }
    }

    public $css = [
        'https://fonts.googleapis.com/icon?family=Material+Icons'
    ];
}