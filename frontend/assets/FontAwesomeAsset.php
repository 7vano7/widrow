<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class FontAwesomeAsset extends AssetBundle
{
    public $sourcePath = '@admin_lte_bower';

    public $css = [
        'font-awesome/css/font-awesome.min.css',
    ];

    public $js = [];

    public $depends = [];
}
