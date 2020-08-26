<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class FastclickAsset extends AssetBundle
{
    public $sourcePath = '@admin_lte_bower';

    public $css = [];

    public $js = [
        'fastclick/lib/fastclick.js'
    ];

    public $depends = [];
}
