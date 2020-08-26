<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class MainTemplateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [
        'js/jquery.slugify.js'
    ];

    public $depends = [
        //'frontend\assets\IEAsset',
        //'frontend\assets\InitAsset',
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'frontend\assets\FontAwesomeAsset',
        //'frontend\assets\IoniconsAsset',
        // 'frontend\assets\SlimscrollAsset',
        // 'frontend\assets\FastclickAsset',
        // 'yii\bootstrap\BootstrapPluginAsset',
        'frontend\assets\BootstrapAsset',
        'frontend\assets\AdminLTEAsset',
        'frontend\assets\FontAsset',
        'frontend\assets\FlagsAsset',
        'frontend\assets\CommonAsset',
    ];
}
