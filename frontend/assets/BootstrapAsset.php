<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class BootstrapAsset extends AssetBundle
{
    public $sourcePath = '@admin_lte_bower';

    public $css = [
        'bootstrap/dist/css/bootstrap.min.css',
    ];

    public $js = [
        'bootstrap/dist/js/bootstrap.min.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
