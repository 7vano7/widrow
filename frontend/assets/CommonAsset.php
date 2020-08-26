<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class CommonAsset extends AssetBundle
{
    public $sourcePath = '@admin_lte';

    public $css = [
        'css/common.css',
    ];

    public $js = [
        'js/common.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
