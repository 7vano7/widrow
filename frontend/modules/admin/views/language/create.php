<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Language */

$this->title = Yii::t('language', 'Create language');
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
            <?php echo Yii::t('admin', 'Create'); ?>
        </h1>
    </div>
    <div class="box-body">
        <div class="language-create">
            <h1><?= Html::encode($this->title) ?></h1>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
