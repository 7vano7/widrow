<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \yii2mod\rbac\models\BizRuleModel */

$this->title = Yii::t('access', 'Rule : {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('access', 'Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
//$this->render('/layouts/_sidebar');
?>

<div class="box">
    <div class="box-header with-border">
        <h1 class="box-title">
            <h1><?php echo Html::encode($this->title); ?></h1>
        </h1>
        <p>
            <?php if (Yii::$app->user->can('access.rule.update')) {
                echo Html::a(Yii::t('access', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']);
            }
            if (Yii::$app->user->can('access.rule.delete')) {
                echo Html::a(Yii::t('access', 'Delete'), ['delete', 'id' => $model->name], [
                    'class' => 'btn btn-danger',
                    'data-confirm' => Yii::t('access', 'Are you sure to delete this item?'),
                    'data-method' => 'post',
                ]);
            } ?>
        </p>
    </div>

    <div class="box-body">
        <?php echo $this->render('/layouts/_sidebar'); ?>
        <div class="assignment-index">

            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'className',
                ],
            ]); ?>

        </div>
    </div>
</div>

