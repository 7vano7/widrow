<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class SlimscrollAsset extends AssetBundle
{
    public $sourcePath = '@admin_lte_bower';

    public $css = [];

    public $js = [
        'jquery-slimscroll/jquery.slimscroll.min.js'
    ];

    public $depends = [];
}
