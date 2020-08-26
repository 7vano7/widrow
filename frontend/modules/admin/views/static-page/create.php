<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\StaticPage */

$this->title = Yii::t('static', 'Create static page');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Static'), 'url' => ['index']];
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
        <?php echo Yii::t('admin', 'Static page'); ?>
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
