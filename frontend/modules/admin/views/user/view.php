<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use frontend\modules\admin\formatter\UserFormatter;
use frontend\modules\admin\models\User;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Users'), 'url' => ['index']];
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
            <?php echo Yii::t('admin', 'View') . ' ' . $model->username; ?>
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
                    'google_auth',
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
                ],
            ]) ?>
        </div>
    </div>
</div>
