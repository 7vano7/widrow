<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \yii2mod\rbac\models\AuthItemModel */

$context = $this->context;
$labels = $this->context->getLabels();
$this->title = Yii::t('access', 'Update ' . $labels['Item'] . ' : {0}', $model->name);
$this->params['breadcrumbs'][] = ['label' => Yii::t('access', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('access', 'Update');
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
            <?php echo Yii::t('access', 'Update : {name}', [
                'name' => $model->name,
            ]); ?>
        </h1>
    </div>
    <div class="box-body">

        <div class="auth-item-update">

            <h1><?= Html::encode($this->title) ?></h1>

            <?php echo $this->render('_form', [
                'model' => $model,
            ]); ?>

        </div>
    </div>
</div>