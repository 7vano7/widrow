<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class AdminLTEAsset extends AssetBundle
{
    public $sourcePath = '@admin_lte';

    public $css = [
        'dist/css/AdminLTE.min.css',
        'dist/css/skins/_all-skins.min.css',
    ];

    public $js = [
        'dist/js/adminlte.min.js',
        //'dist/js/demo.js',
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
