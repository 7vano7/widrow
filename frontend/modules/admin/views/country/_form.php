<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use frontend\modules\admin\models\Language;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\Country */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['autofocus'=>true, 'maxlength' => true]) ?>

    <?= $form->field($model, 'iso_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('admin','Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
