<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\StaticPage */

$this->title = Yii::t('static', 'Update static');
$this->params['breadcrumbs'][] = ['label' => 'static', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Update');

?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Static'); ?>
    </h1>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">
            <?php echo Yii::t('static', 'Update static'); ?>
        </h1>
    </div>
    <div class="box-body">
        <div class="static-update">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
