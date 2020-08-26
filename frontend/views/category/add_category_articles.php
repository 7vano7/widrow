<?php
/**
 * @var $models array
 */

use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php if($models):?>
    <?php foreach ($models as $model): ?>
        <?php $i = 0; ?>
        <div class="row">
            <div class="col-sm-3">
                <div><?php echo Html::img($model->article->gif ? Yii::getAlias('@web').$model->article->gif :
                        Yii::getAlias('@web').$model->article->image) ?>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="col-sm-12">
                    <h3><?php echo Html::a($model->title, Url::toRoute('/article/' . $model->article->url)); ?><h3>
                </div>
                <div class="col-sm-12 article-desc">
                    <?php echo $model->short_desc; ?>
                </div>
                <div class="pull-left">
                    <?php echo $model->article->created_at; ?>
                </div>
                <div class="pull-right">
                    <?php echo Html::a(Yii::t('site', 'Show').' <span class="glyphicon glyphicon-circle-arrow-right"></span>', Url::toRoute('/article/'.$model->article->url)); ?>
                </div>
            </div>
        </div>
        <?php $i++;?>
    <?php endforeach; ?>
    <?php if($i == 49):?>
        <div class="col-sm-12 more">
            <a class="add-category-article" href="#"><?php echo Yii::t('site', 'More articles')
                ?> <span class="glyphicon glyphicon-circle-arrow-down"></span></a>
        </div>
    <?php endif ?>
<?php endif ?>
