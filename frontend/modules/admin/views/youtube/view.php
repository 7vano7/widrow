<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\admin\formatter\ArticleFormatter;
use frontend\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Article */


$this->title = Yii::t('admin', 'Youtube');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Youtube'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Youtube'); ?>
    </h1>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">
            <?php echo Yii::t('admin', 'View'); ?>
        </h1>
    </div>
    <div class="box-header with-border">
        <p>
            <?php if (\Yii::$app->user->can(User::ROLE_MANAGER)): ?>
                <?= Html::a(Yii::t('admin', 'List'), ['index'], ['class' => 'btn btn-success']) ?>
            <?php endif; ?>

            <?php if (\Yii::$app->user->can(User::ROLE_MANAGER)): ?>
                <?= Html::a(Yii::t('admin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif; ?>

            <?php if (\Yii::$app->user->can(User::ROLE_MANAGER)): ?>
                <?= Html::a(Yii::t('admin', 'Delete'), ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => Yii::t('admin', 'Are you sure you want to delete this item?'),
                        'method' => 'post',
                    ],
                ]) ?>
            <?php endif; ?>
        </p>
    </div>
    <div class="box-header with-border">

        <div class="coach-view">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#panel1"><?php echo Yii::t('admin', 'Main info') ?></a>
                </li>
                <?php
                $models = $model->articleTranslation;
                foreach ($models as $lang):?>
                    <li><a data-toggle="tab" href="#<?= $lang->lang ?>"><?= $lang->language->name; ?></a></li>
                <?php endforeach ?>
            </ul>
            <div class="tab-content">
                <div id="panel1" class="tab-pane fade in active">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'id',
                            [
                                'attribute' => 'image',
                                'value' => function ($data) {
                                    return \Yii::$app->formatter->load(ArticleFormatter::class)->asPhoto($data);
                                },
                                'format' => 'html',
                            ],

                            [
                                'attribute' => 'status',
                                'value' => function ($data) {
                                    return \Yii::$app->formatter->load(ArticleFormatter::class)->asStatus
                                    ($data->status);
                                },
                                'format' => 'html',
                            ],
                            'url',
                            [
                                'attribute' => 'created_at',
                                'value' => function ($data) {
                                    return \Yii::$app->formatter->asDateTime($data->created_at, 'long');
                                },
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'updated_at',
                                'value' => function ($data) {
                                    return \Yii::$app->formatter->asDateTime($data->updated_at, 'long');
                                },
                                'format' => 'raw',
                            ],
                        ],
                    ]) ?>
                </div>
                <?php foreach ($models as $lang): ?>
                    <div id="<?= $lang->lang ?>" class="tab-pane fade in ">
                        <?= DetailView::widget([
                            'model' => $lang,
                            'attributes' => [
                                [
                                    'attribute' => 'lang',
                                    'value' => function ($data) {
                                        return \Yii::$app->formatter->load(ArticleFormatter::class)->asLang($data);
                                    },
                                    'format' => 'html',
                                ],
                                [
                                    'attribute' => 'title',
                                    'value' => function ($data) {
                                        return \Yii::$app->formatter->load(ArticleFormatter::class)->asTitleLang($data->title);
                                    },
                                    'format' => 'raw',
                                ],
                                [
                                    'attribute' => 'short_desc',
                                    'format' => 'raw',
                                ],
                                [
                                    'attribute' => 'seo_title',
                                    'format' => 'raw',
                                ],
                                [
                                    'attribute' => 'seo_description',
                                    'format' => 'raw',
                                ],
                                [
                                    'attribute' => 'seo_keywords',
                                    'format' => 'raw',
                                ],
                            ],
                        ]) ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>


