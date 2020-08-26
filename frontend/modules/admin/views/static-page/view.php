<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\admin\formatter\StaticPageFormatter;
use frontend\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\StatucPage */

$this->title = Yii::t('admin', 'Static');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Static'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Static'); ?>
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
        <div class="menu-view">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#panel1"><?php echo Yii::t('admin', 'Main info') ?></a>
                </li>
                <?php
                $models = $model->pageTranslation;
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
                                'attribute' => 'status',
                                'value' => function ($data) {
                                    return \Yii::$app->formatter->load(StaticPageFormatter::class)->asStatus($data->status);
                                },
                                'format' => 'html',
                            ],
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
                                    'attribute' => Yii::t('static', 'Lang'),
                                    'value' => function ($data) {
                                        return \Yii::$app->formatter->load(StaticPageFormatter::class)->asLang($data);
                                    },
                                    'format' => 'html',
                                ],
                                [
                                    'attribute' => Yii::t('static', 'Title'),
                                    'value' => function ($data) {
                                        return $data->title;
                                    },
                                    'format' => 'html',
                                ],
                                [
                                    'attribute' => Yii::t('static', 'Content'),
                                    'value' => function ($data) {
                                        return $data->content;
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
