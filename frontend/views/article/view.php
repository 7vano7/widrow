<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $model \frontend\models\Article;
 * @var $list array
 * @var $url string
 */
Yii::$app->formatter->locale = Yii::$app->language;
if(Yii::$app->formatter->locale == 'ua')
    Yii::$app->formatter->locale = 'uk';
?>
<div class="article-show">
    <?php if (!$model): ?>
        <div class="not-found">
            <?php echo Yii::t('site', 'No articles at this category') ?>
        </div>
    <?php else: ?>
        <div class="category-articles">
            <h4 class="cat-name">
                <?php echo Html::a($model->article->getCategoryName($model->article->category)->menu_name,
                    Url::toRoute('category/'.$url)); ?>
            </h4>
            <div class="article">
                <h2><?php echo $model->title ?></h2>
                <div class="date">
                    <?php echo Yii::t('site', 'Published') .  Yii::$app->formatter->asDate($model->article->created_at,
                            'php:d F Y'); ?>
                </div>
                <div class="short-desc">
                    <?php echo $model->seo_description ? $model->seo_description : $model->short_desc; ?>
                </div>
                <div class="">
                    <?php echo Html::img(Yii::getAlias('@web').$model->article->image); ?>
                </div>
                <div class="article-content">
                    <?php echo $model->content; ?>
                </div>
                <?php if($model->seo_keywords):?>
                <?php $tags = explode(',', $model->seo_keywords);?>
                <div class="tags">
                    <?php foreach ($tags as $tag):?>
                        <a href="<?php echo Url::toRoute(['/search', 'id'=>$tag])?>" class="btn btn-default"><?php
                                echo $tag;?></a>
                    <?php endforeach;?>

                </div>
                <?php endif; ?>
                <div class="center">
                    <div class="btn-share">
                    <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i>
                        <?php echo Yii::t('site', 'Like facebook') ?></a>
                    </div>
                <div class="btn-share">
                    <a href="#" class="btn btn-block btn-social btn-twitter btn-flat"><i class="fa fa-twitter"></i>
                        <?php echo Yii::t('site', 'Twit') ?></a>
                </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>
<div class="list-item">
    <div class="list-articles show-list">
        <h3><?php echo Yii::t('site', 'New') ?></h3>
        <?php if (empty($list)): ?>
            <div class="not-found">
                <?php echo Yii::t('site', 'No articles at this category') ?>
            </div>
        <?php else: ?>
            <?php foreach ($list as $item): ?>
                <div class="row">
                    <div class="col-sm-4 article-image">
                        <?php echo Html::a(Html::img(Yii::getAlias('@web') .$item->article->image), Url::toRoute('/article/' . $item->article->url));
                        ?>
                    </div>
                    <div class="col-sm-8 category-title">
                        <?php echo Html::a($item->title, Url::toRoute('/article/' . $item->article->url)) ?>
                    </div>
                        <div class="pull-left"><?php echo Yii::$app->formatter->asDate($item->article->created_at, 'php:d F Y'); ?></div>
                    <div class="col-sm-8 article-desc">
                        <?php echo $item->seo_description ? $item->seo_description : $item->short_desc ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>