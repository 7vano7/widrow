<?php
namespace frontend\assets;

use yii\web\AssetBundle;

class InitAsset extends AssetBundle
{
    public $sourcePath = '@admin_lte';

    public $css = [
        'css/reset.css',
    ];

    public $js = [];

    public $depends = [];
}
