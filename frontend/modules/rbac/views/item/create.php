<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \yii2mod\rbac\models\AuthItemModel */

$labels = $this->context->getLabels();
$this->title = Yii::t('access', 'Create ' . $labels['Item']);
$this->params['breadcrumbs'][] = ['label' => Yii::t('access', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
?>
<div class="page-header">
<h1>
    <?php echo Yii::t('access', 'Access rules'); ?>
</h1>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">
            <?php echo Yii::t('admin', 'Create', [
                'name' => $model->name,
            ]); ?>
        </h1>
    </div>
    <div class="box-body">

        <div class="auth-item-create">

            <h1><?= Html::encode($this->title) ?></h1>

            <?php echo $this->render('_form', [
                'model' => $model,
            ]); ?>

        </div>
    </div>
</div>