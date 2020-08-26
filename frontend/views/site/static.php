<?php

use frontend\models\StaticPage;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $model StaticPage
 */
?>
<div class="col-sm-12">
    <div class="container static">
        <div class="col-sm-12">
            <h3><?php echo $model->title?></h3>
            <div class="col-sm-12">
                <?php echo $model->content;?>
            </div>
        </div>
    </div>
</div>