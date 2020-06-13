<?php
/**
 * Created by PhpStorm.
 * User: sparrow
 * Date: 12/11/19
 * Time: 9:14 PM
 */

namespace app\assets;


use yii\web\AssetBundle;

class SiteContactAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/site-contact.css',
    ];

    public $js = [
        'js/plugins/formatter/cleave.min.js',
        'js/plugins/formatter/cleave-phone.i18n.js',
        'js/contact.js',
        'js/openmap.js',
    ];

    public $depends = [
        'app\assets\AppAsset',
        LeafletAsset::class,
        GoogleRecaptchaV3Asset::class,
    ];
}