<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
//        'css/site.css',
//        'css/main.css',
//        'css/noscript.css'

    ];
    public $js = [
//        'js/jquery.scrollex.min.js',
//        'js/jquery.scrolly.min.js',
//        'js/browser.min.js',
//        'js/breakpoints.min.js',
//        'js/util.js',
//        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
        'frontend\assets\BootstrapAsset',
        'frontend\assets\FontAwesomeAsset',
//        'frontend\assets\AdminLTEAsset',
//        'frontend\assets\FontAsset',
//        'frontend\assets\FlagsAsset',
    ];
}
