<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Menu */

$this->title = Yii::t('admin', 'Update') . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Country'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');

?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Country'); ?>
    </h1>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">
            <?php echo Yii::t('country', 'Update country: {name}', [
                'name' => $model->name,
            ]); ?>
        </h1>
    </div>
    <div class="box-body">
        <div class="menu-update">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
