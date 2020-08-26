<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;

/**
 * @var $list array;
 */
?>
<div class="col-sm-12">
    <?php if(empty($list)) {
    throw new NotFoundHttpException( Yii::t('site', 'Not found'));
    } ?>
    <div class="container search">
        <h3><?php echo Yii::t('site', 'Search articles')?></h3>
        <?php foreach ($list as $item): ?>
            <div class="col-sm-12">
                <div class="col-sm-3 vcenter">
                    <?php echo Html::a(Html::img(Yii::getAlias('@web') .$item->article->image), Url::toRoute('/article/' . $item->article->url));
                    ?>
                </div>
                <div class="col-sm-8 vcenter">
                    <h3>
                        <?php echo Html::a($item->title, Url::toRoute('/article/'.$item->article->url))?>
                    </h3>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>