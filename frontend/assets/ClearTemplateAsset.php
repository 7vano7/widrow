<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class ClearTemplateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [];
    public $js = [];

    public $depends = [
        'frontend\assets\IEAsset',
        'frontend\assets\InitAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\web\JqueryAsset',
        'frontend\assets\FontAwesomeAsset',
        'frontend\assets\IoniconsAsset',
        'frontend\assets\iCheckAsset',
        'frontend\assets\FontAsset',
        'frontend\assets\AdminLTEAsset',
        'frontend\assets\CommonAsset',
    ];
}
