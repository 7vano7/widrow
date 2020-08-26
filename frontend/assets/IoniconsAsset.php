<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class IoniconsAsset extends AssetBundle
{
    public $sourcePath = '@admin_lte_bower';

    public $css = [
        'Ionicons/css/ionicons.min.css',
    ];

    public $js = [];

    public $depends = [];
}
