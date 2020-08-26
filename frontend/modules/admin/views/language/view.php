<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\admin\formatter\LanguageFormatter;
use frontend\modules\admin\models\User;


/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Language */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Language'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Language'); ?>
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
        <div class="language-view">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'name',
                    'iso_code',
                    [
                        'attribute' => 'status',
                        'value' => function ($data) {
                            return \Yii::$app->formatter->load(LanguageFormatter::class)->asStatus($data->status);
                        },
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'main',
                        'value' => function ($data) {
                            return \Yii::$app->formatter->load(LanguageFormatter::class)->asMain($data->main);
                        },
                        'format' => 'raw',
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>
