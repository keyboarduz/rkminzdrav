<?php
/**
 * Created by PhpStorm.
 * User: sparrow
 * Date: 12/9/19
 * Time: 2:35 AM
 */

namespace app\assets;


use yii\web\AssetBundle;

class OrganizationAsset extends AssetBundle
{
    public $baseUrl = '@web';
    public $basePath = '@webroot';

    public $css = [
        'css/organization-page.css',
    ];

    public $depends = [
        'app\assets\AppAsset',
    ];
}