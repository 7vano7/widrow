<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $models array
 */
Yii::$app->formatter->locale = Yii::$app->language;
if (Yii::$app->formatter->locale == 'ua')
    Yii::$app->formatter->locale = 'uk';
?>
<div class="menu-category">
    <?php if (empty($list)): ?>
        <div class="not-found">
            <?php echo Yii::t('site', 'No articles at this category') ?>
        </div>
    <?php else: ?>
    <div class="list-articles">
        <h3><?php echo Yii::t('site', 'Last articles') ?></h3>
        <?php $j = 0; ?>
        <?php foreach ($list as $item): ?>
            <?php if (isset($item['items'][0])): ?>
                <div class="category-name"> <?php echo Html::a($item['items'][0]->article->getCategoryName($item['id'])
                        ->menu_name, Url::toRoute($item['url'])); ?>
                    <?php foreach ($item['items'] as $data): ?>
                        <div class="col-sm-12 row">
                            <div class="col-sm-4 img-list">
                                <?php echo Html::a(Html::img($data->article->image), Url::toRoute('/article/' . $data->article->url)); ?>
                            </div>
                            <div class="col-sm-8">
                                <div class="category-title"><?php echo Html::a($data->title,
                                        Url::toRoute('/article/' . $data->article->url));
                                    ?>
                                </div>
                                <div class="pull-left"><?php echo Yii::$app->formatter->asDate($data->article->created_at, 'php:d F Y'); ?></div>
                                <div class="col-sm-12 article-desc">
                                    <?php echo $data->seo_description ? $data->seo_description : $data->short_desc ?>
                                </div>
                            </div>
                        </div>
                        <?php $j++; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif ?>
        <?php endforeach; ?>
        <?php if ($j == 49): ?>
            <div class="col-sm-12 more">
                <a class="add-list-article" href="#"><?php echo Yii::t('site', 'More articles')
                    ?> <span class="glyphicon glyphicon-circle-arrow-down"></span></a>
            </div>
        <?php endif ?>
    </div>
</div>
<div class="content">
    <div class="category-articles">
        <?php if (empty($models)): ?>
            <div class="not-found">
                <?php echo Yii::t('site', 'No articles at this category') ?>
            </div>
        <?php else: ?>
            <h2>
                <?php echo $models[0]->article->getCategoryName($models[0]->article->category)->menu_name; ?>
            </h2>
            <div class="col-sm-12 category">
                <?php foreach ($models as $model): ?>
                    <?php $i = 0; ?>
                    <div class="row" data-id="<?php echo $model->article_id ?>" data-category="<?php echo
                    $model->article->category ?>">
                        <div class="col-sm-4">
                            <div>
                                <?php echo Html::a(
                                    Html::img($model->article->gif ? Yii::getAlias('@web') . $model->article->gif :
                                        Yii::getAlias('@web') . $model->article->image), Url::toRoute('/article/' . $model->article->url)) ?>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="col-sm-12 title-article">
                                <h3><?php echo Html::a($model->title, Url::toRoute('/article/' . $model->article->url));
                                    ?></h3>
                            </div>
                            <div class="pull-left">
                                <?php echo Yii::$app->formatter->asDate($model->article->created_at, 'php:d F Y'); ?>
                            </div>
                            <div class="col-sm-12 desc-show">
                                <?php echo $model->seo_description ? $model->seo_description : $model->short_desc; ?>
                            </div>
                            <div class="pull-right">
                                <?php echo Html::a(Yii::t('site', 'Show') . ' <span class="glyphicon
                                 glyphicon-circle-arrow-right"></span>', Url::toRoute('/article/' . $model->article->url)); ?>
                            </div>
                        </div>
                    </div>
                    <?php $i++; ?>
                <?php endforeach; ?>
                <?php if ($i == 49): ?>
                    <div class="col-sm-12 more">
                        <a class="add-category-article" href="#"><?php echo Yii::t('site', 'More articles')
                            ?> <span class="glyphicon glyphicon-circle-arrow-down"></span></a>
                    </div>
                <?php endif ?>
            </div>
        <?php endif; ?>
    </div>
    <?php endif ?>
</div>

<?php $script = "
$(document).ready(function(){
    $('.category').on('click', '.add-category-article', function(){
        var id = $('.category .row').last().attr('data-id');
        var category = $('.category .row').last().attr('data-category');
        $.ajax({
             url: '" . Url::toRoute('/category/addarticles') . "',
            type:'post',
            data:{index:id, category:category},
            dataType:'json',
            success: function(res)
            {
                if(res)
                {
                   $('.category .more').remove();
                   $('.category').append(res.content);
                }
                else
                {
                    console.log('no');
                }
            },
            error: function()
            {
                alert('Ошибка подключения!');
            }
        });
        return false;
    });
    $('.list-articles').on('click', '.add-list-article', function(){
        var id = $('.category-title').last().attr('data-id');
        $.ajax({
             url: '/category/listarticles',
            type:'post',
            data:{index:id},
            dataType:'json',
            success: function(res)
            {
                if(res)
                {
                   $('.list-articles .more').remove();
                   $('.list-articles').append(res.content);
                }
                else
                {
                    console.log('no');
                }
            },
            error: function()
            {
                alert('Ошибка подключения!');
            }
        });
        return false;
    });
});
"; ?>

<?php $this->registerJs($script, yii\web\View::POS_END); ?>
