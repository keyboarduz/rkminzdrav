<?php


namespace app\modules\admin\assets;


use app\assets\GoogleRecaptchaV3Asset;
use dmstr\web\AdminLteAsset;
use yii\web\AssetBundle;

class AdminLoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/admin.css',
    ];

    public $depends = [
        AdminLteAsset::class,
        GoogleRecaptchaV3Asset::class,
    ];
}