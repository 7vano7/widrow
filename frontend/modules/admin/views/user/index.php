<?php

use yii\helpers\Html;
use yii\grid\GridView;
use frontend\modules\admin\formatter\UserFormatter;
use frontend\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Users'); ?>
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
                <?php if (\Yii::$app->user->can(User::ROLE_ADMIN)): ?>
                    <p>
                        <?= Html::a(Yii::t('admin', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>
                    </p>
                <?php endif ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        'id',
                        'username',
                        'email',
                        [
                            'attribute' => 'role',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(UserFormatter::class)->asRole($data->role);
                            },
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'active',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(UserFormatter::class)->asActive($data->active);
                            },
                            'format' => 'raw',
                        ],
                        [
                            'attribute' => 'status',
                            'value' => function ($data) {
                                return \Yii::$app->formatter->load(UserFormatter::class)->asStatus($data->status);
                            },
                            'format' => 'raw',
                        ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete} {active} ',
                            'buttons' => [
                                'active' => function ($url, $model, $key) {
                                    if ($model->status == (new User())::STATUS_ACTIVE) {
                                        return Html::a('<span class="glyphicon glyphicon-lock"></span>', $url, [
                                            'title' => Yii::t('admin', 'Lock'),
                                            'aria-label' => Yii::t('admin', 'Lock'),
                                            'data-pjax' => Yii::t('admin', 'Lock'),
                                        ]);
                                    } else {
                                        return Html::a('<span class="glyphicon glyphicon-check"></span>', $url, [
                                            'title' => Yii::t('admin', 'Unlock'),
                                            'aria-label' => Yii::t('admin', 'Unlock'),
                                            'data-pjax' => Yii::t('admin', 'Unlock'),
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
                                'active' => function ($model, $key, $index) {
                                    return \Yii::$app->user->can(User::ROLE_ADMIN, ['user' => $model]);
                                },
                                'view' => function ($model, $key, $index) {
                                    return \Yii::$app->user->can(User::ROLE_ADMIN, ['user' => $model]);
                                },
                                'update' => function ($model, $key, $index) {
                                    return \Yii::$app->user->can(User::ROLE_ADMIN, ['user' => $model]);
                                },
                                'delete' => function ($model, $key, $index) {
                                    return \Yii::$app->user->can(User::ROLE_ADMIN, ['user' => $model]);
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
