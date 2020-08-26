<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Article */

$this->title = Yii::t('article', 'Create youtube');
$this->params['breadcrumbs'][] = ['label' => Yii::t('article', 'Create youtube'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Youtube'); ?>
    </h1>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">
            <?php echo Yii::t('admin', 'Create'); ?>
        </h1>
    </div>
    <div class="box-body">
        <div class="article-create">
            <h1><?= Html::encode($this->title) ?></h1>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
