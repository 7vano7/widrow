<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\admin\models\Country;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Language */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="language-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->dropDownList((new Country())->getList(), ['prompt'=>Yii::t('language', 'Select name')]) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatuses(), ['prompt'=>Yii::t('language', 'Select status')]) ?>

    <?php if(!$model->isNewRecord):?>

    <?= $form->field($model, 'main')->dropDownList($model->getMain(), ['prompt'=>Yii::t('language', 'Select main')]) ?>
    <?php endif ?>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('admin', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
