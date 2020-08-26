<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\modules\admin\formatter\ArticleFormatter;
use frontend\modules\admin\models\User;
use frontend\modules\admin\models\Article;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\admin\models\ArticleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


$this->title = Yii::t('admin', 'Article');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Article'); ?>
    </h1>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">
            <?php echo Yii::t('admin', 'List'); ?>
        </h1>
    </div>
    <div class="box-body">
        <div class="device-index">
            <div class="article-index">
                <?php if (\Yii::$app->user->can(User::ROLE_MANAGER)): ?>
                    <p>
                        <?= Html::a(Yii::t('admin', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                <?php endif ?>

                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel'=>$searchModel,
                    'columns' => [
                        'id',
                        [
                            'attribute' => 'image',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(ArticleFormatter::class)->asPhoto($data);
                            },
                            'filter'=>false,
                            'format' => 'html',
                        ],
                        [
                            'attribute' => 'category',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(ArticleFormatter::class)->asCategory($data);
                            },
                            'filter'=>Html::activeDropDownList($searchModel, 'category', $searchModel->getCategory
                            (Yii::$app->language), ['class' =>
                                'form-control', 'prompt' => Yii::t('admin','--All--')]),
                            'format' => 'html',
                        ],
//                        [
//                            'attribute' => 'lang',
//                            'label' => Yii::t('article', 'Language'),
//                            'value' => function ($data) {
//                                return \Yii::$app->formatter->load(ArticleFormatter::class)->asLang($data);
//                            },
//                            'filter'=>Html::activeDropDownList($searchModel, 'lang', (new Language())->getList(),
//                             ['class' =>
//                                'form-control', 'prompt' => Yii::t('admin','--All--')]),
//                            'format' => 'html',
//                        ],
                        [
                            'attribute' => 'title',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(ArticleFormatter::class)->asTitle($data);
                            },
                            'format' => 'html',
                        ],
                        [
                            'attribute' => 'user_id',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(ArticleFormatter::class)->asUser($data->user_id);
                            },
                            'filter'=>Html::activeDropDownList($searchModel, 'user_id', (new User())->getList(), ['class' =>
                                'form-control', 'prompt' => Yii::t('admin','--All--')]),
                            'format' => 'html',
                            'format' => 'html',
                        ],
                        [
                            'attribute' => 'top',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(ArticleFormatter::class)->asTop($data->top);
                            },
                            'filter'=>Html::activeDropDownList($searchModel, 'top', $searchModel->getTop(),
                                ['class' => 'form-control', 'prompt' => Yii::t('admin','--All--')]),
                            'format' => 'html',
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(ArticleFormatter::class)->asStatus($data->status);
                            },
                            'filter'=>Html::activeDropDownList($searchModel, 'status', $searchModel->getStatuses(),
                                ['class' => 'form-control', 'prompt' => Yii::t('admin','--All--')]),
                            'format' => 'html',
                        ],
                        'url',
                        [
                            'attribute' => 'created_at',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->asDateTime($data->created_at, 'long');
                            },
                        ],
                        [
                            'attribute' => 'updated_at',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->asDateTime($data->updated_at, 'long');
                            },
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{top} {view} {update} {status} {delete}',
                            'buttons' => [
                                'top' => function ($url, $model, $key) {
                                    if ($model->top == (new Article())::IS_TOP) {
                                        return Html::a('<span class="glyphicon glyphicon-import"></span>', $url, [
                                            'title' => Yii::t('admin', 'Out top'),
                                            'aria-label' => Yii::t('admin', 'Out top'),
                                            'data-pjax' => Yii::t('admin', 'Out top'),
                                        ]);
                                    } else {
                                        return Html::a('<span class="glyphicon glyphicon-export"></span>', $url, [
                                            'title' => Yii::t('admin', 'In top'),
                                            'aria-label' => Yii::t('admin', 'In top'),
                                            'data-pjax' => Yii::t('admin', 'In top'),
                                        ]);
                                    }
                                },
                                'status' => function ($url, $model, $key) {
                                    if ($model->status == (new Article())::STATUS_ACTIVE) {
                                        return Html::a('<span class="glyphicon glyphicon-lock"></span>', $url, [
                                            'title' => Yii::t('admin', 'Not public'),
                                            'aria-label' => Yii::t('admin', 'Not public'),
                                            'data-pjax' => Yii::t('admin', 'Not public'),
                                        ]);
                                    } else {
                                        return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, [
                                            'title' => Yii::t('admin', 'Public'),
                                            'aria-label' => Yii::t('admin', 'Public'),
                                            'data-pjax' => Yii::t('admin', 'Public'),
                                        ]);
                                    }
                                },
                                'view' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                        'title' => Yii::t('admin', 'View'),
                                        'aria-label' => Yii::t('admin', 'View'),
                                        'data-pjax' => Yii::t('admin', 'View'),
                                    ]);
                                },
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                        'title' => Yii::t('admin', 'Update'),
                                        'aria-label' => Yii::t('admin', 'Update'),
                                        'data-pjax' => Yii::t('admin', 'Update'),
                                    ]);
                                },
                                'delete' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                        'title' => Yii::t('admin', 'Delete'),
                                        'aria-label' => Yii::t('admin', 'Delete'),
                                        'data-pjax' => Yii::t('admin', 'Delete'),
                                        'data' => ['confirm' => Yii::t('admin', 'Are you sure you want to delete this item?'), 'method' => 'POST'],
                                    ]);
                                },
                            ],
                            'visibleButtons' => [
                                'view' => function ($model, $key, $index) {
                                    return \Yii::$app->user->can(User::ROLE_MANAGER, ['user' => $model]);
                                },
                                'update' => function ($model, $key, $index) {
                                    return \Yii::$app->user->can(User::ROLE_MANAGER, ['user' => $model]);
                                },
                                'delete' => function ($model, $key, $index) {
                                    return \Yii::$app->user->can(User::ROLE_MANAGER, ['user' => $model]);
                                },
                            ],
                            'headerOptions' => ['style' => 'text-align: center; vertical-align: middle; width:100px'],
                            'contentOptions' => ['style' => 'text-align: center; vertical-align: middle;'],
                        ],
                    ],
                ]); ?>
            </div>
        </div>
    </div>
</div>
