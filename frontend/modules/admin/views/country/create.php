<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Country */

$this->title = Yii::t('country','Create country');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin','Country'), 'url' => ['index']];
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
            <?php echo Yii::t('admin', 'Create', [
                'name' => $model->name,
            ]); ?>
        </h1>
    </div>
    <div class="box-body">
        <div class="menu-create">
            <h1><?= Html::encode($this->title) ?></h1>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
