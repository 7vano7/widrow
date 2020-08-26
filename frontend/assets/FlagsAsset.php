<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class FlagsAsset extends AssetBundle
{
    public $sourcePath = '@admin_lte_plugins';

    public $css = [
        'flags/css/flag-icon.css'
    ];

    public $js = [];

    public $depends = [];
}
