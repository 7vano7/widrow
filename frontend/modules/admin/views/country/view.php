<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\admin\formatter\CountryFormatter;
use frontend\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Country */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Country'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Country'); ?>
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
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    [
                        'attribute' => Yii::t('country', 'Iso code'),
                        'value' => function ($data) {
                            return \Yii::$app->formatter->load(CountryFormatter::class)->asLang($data);
                        },
                        'format' => 'raw',
                    ],
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
    </div>
</div>
