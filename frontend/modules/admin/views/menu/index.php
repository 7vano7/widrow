<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\modules\admin\formatter\MenuFormatter;
use frontend\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\admin\models\MenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Menu');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Menu'); ?>
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
            <div class="menu-index">
                <?php if (\Yii::$app->user->can(User::ROLE_MANAGER)): ?>
                    <p>
                        <?= Html::a(Yii::t('admin', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                <?php endif ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id',
                        [
                            'attribute' => 'image',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(MenuFormatter::class)->asImages($data->image);
                            },
                            'format' => 'html',
                        ],
                        [
                            'attribute' => 'menu_name',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(MenuFormatter::class)->asName($data);
                            },
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(MenuFormatter::class)->asStatus($data->status);
                            },
                            'format' => 'raw',
                        ],
                        'url',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete} ',
                            'buttons' => [
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
