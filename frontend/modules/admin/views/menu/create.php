<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Menu */

$this->title = Yii::t('menu', 'Create menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Menu'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$title = '';
if (!empty($model->newsLang)) {
    foreach ($model->newsLang as $menu) {
        if ($menu->lang == Yii::$app->language) {
            $title = $menu->menu_name;
        }
    }
}
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Menu'); ?>
    </h1>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">
            <?php echo Yii::t('admin', 'Create', [
                'title' => $title,
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
