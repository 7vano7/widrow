<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\admin\formatter\MenuFormatter;
use frontend\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Menu */

$this->title = Yii::t('admin', 'Menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Menu'), 'url' => ['index']];
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
            <?php echo Yii::t('admin', 'View'); ?>
        </h1>
    </div>
    <div class="box-header with-border">
        <p>
            <?php if (\Yii::$app->user->can(User::ROLE_ADMIN)): ?>
                <?= Html::a(Yii::t('admin', 'List'), ['index'], ['class' => 'btn btn-success']) ?>
            <?php endif; ?>

            <?php if (\Yii::$app->user->can(User::ROLE_ADMIN)): ?>
                <?= Html::a(Yii::t('admin', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif; ?>

            <?php if (\Yii::$app->user->can(User::ROLE_ADMIN)): ?>
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
        <div class="menu-view">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#panel1"><?php echo Yii::t('admin', 'Main info') ?></a>
                </li>
                <?php
                $models = $model->menuLang;
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
                                'attribute' => Yii::t('menu', 'Image'),
                                'value' => function ($data) {
                                    return \Yii::$app->formatter->load(MenuFormatter::class)->asImages($data->image);
                                },
                                'format' => 'html',
                            ],
                            [
                                'attribute' => 'status',
                                'value' => function ($data) {
                                    return \Yii::$app->formatter->load(MenuFormatter::class)->asStatus($data->status);
                                },
                                'format' => 'html',
                            ],
                            'position',
                            'url',
                        ],
                    ]) ?>
                </div>
                <?php foreach ($models as $lang): ?>
                    <div id="<?= $lang->lang ?>" class="tab-pane fade in ">
                        <?= DetailView::widget([
                            'model' => $lang,
                            'attributes' => [
                                [
                                    'attribute' => Yii::t('menu', 'Menu Name'),
                                    'value' => function ($data) {
                                        return \Yii::$app->formatter->load(MenuFormatter::class)->asTitle($data->menu_name);
                                    },
                                    'format' => 'html',
                                ],
                                [
                                    'attribute' => Yii::t('menu', 'Parent name'),
                                    'value' => function ($data) {
                                        return \Yii::$app->formatter->load(MenuFormatter::class)->asParent($data);
                                    },
                                    'format' => 'html',
                                ],
                                [
                                    'attribute' => Yii::t('menu', 'Lang'),
                                    'value' => function ($data) {
                                        return \Yii::$app->formatter->load(MenuFormatter::class)->asLang($data);
                                    },
                                    'format' => 'html',
                                ],
                            ],
                        ]) ?>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</div>
