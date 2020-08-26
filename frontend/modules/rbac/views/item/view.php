<?php

use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\DetailView;
use frontend\modules\rbac\RbacAsset;

RbacAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \yii2mod\rbac\models\AuthItemModel */

$labels = $this->context->getLabels();
$this->title = Yii::t('access', $labels['Item'] . ' : {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('access', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
//$this->render('/layouts/_sidebar');
?>
<div class="page-header">
    <h1>
        <?php echo Html::encode($this->title); ?>
    </h1>
</div>

<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">
            <?php echo Yii::t('admin', 'View'); ?>
        </h1>
    </div>
    <div class="box-header with-border">
        <p class="access-buttons">
            <?php if (Yii::$app->user->can('access.role.create')) {
                echo Html::a(Yii::t('access', 'Create'), ['create'], ['class' => 'btn btn-success']);
            }

            if (Yii::$app->user->can('access.role.update')) {
                echo Html::a(Yii::t('access', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']);
            }
            if (Yii::$app->user->can('access.role.delete')) {
                echo Html::a(Yii::t('access', 'Delete'), ['delete', 'id' => $model->name], [
                    'class' => 'btn btn-danger',
                    'data-confirm' => Yii::t('access', 'Are you sure to delete this item?'),
                    'data-method' => 'post',
                ]);
            } ?>
        </p>
    </div>

     <div class="box-header with-border">
        <?php echo $this->render('/layouts/_sidebar'); ?>
        <div class="assignment-index">

            <?php echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'description:ntext',
                    'ruleName',
                    'data:ntext',
                ],
            ]); ?>

            <?php echo $this->render('../_dualListBox', [
                'opts' => Json::htmlEncode([
                    'items' => $model->getItems(),
                ]),
                'assignUrl' => ['assign', 'id' => $model->name],
                'removeUrl' => ['remove', 'id' => $model->name],
            ]); ?>
        </div>
    </div>
</div>

