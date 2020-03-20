<?php
/**
 * Created by PhpStorm.
 * User: Javlonbek
 * Date: 14.08.2019
 * Time: 23:42
 */

namespace app\modules\admin\assets;


use app\assets\GoogleRecaptchaV3Asset;
use yii\web\AssetBundle;

class AdminPanelAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/admin.css',
    ];

    public $js = [
        'js/admin.js',
        'js/sse.js',
    ];

    public $depends = [
        AdminLteAsset::class,
        GoogleRecaptchaV3Asset::class,
    ];

}