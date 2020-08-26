<?php
use yii\helpers\Html;use yii\helpers\Url;
/**
 * @var $models $array
 */
?>
<?php $j = 0;?>
<?php foreach ($models as $item):?>
    <div class="category-name"> <?php echo $item->article->getCategoryName($item->article->category)->menu_name;
        ?>
        <div class="pull-right"><?php echo $item->article->created_at?></div>
    </div>
    <div class="category-title"><?php echo Html::a($item->title, Url::toRoute('/article/'.$item->article->url));
        ?></div>
    <?php $j++;?>
<?php endforeach;?>
<?php if($j == 49):?>
    <div class="col-sm-12 more">
        <a class="add-list-article" href="#"><?php echo Yii::t('site', 'More articles')
            ?> <span class="glyphicon glyphicon-circle-arrow-down"></span></a>
    </div>
<?php endif ?>