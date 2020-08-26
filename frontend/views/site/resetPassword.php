<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Reset password';
?>

<div class="main col-sm-12 site-reset-password">
    <div class="title">
        <h1><?php echo $this->title; ?></h1>
    </div>
    <div class=" site-login">

        <div class="login-box-body">
            <p class="title"><?php echo Yii::t('site', 'New password')?></p>

            <div class="row">
                <div class="col-sm-12">
                    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                    <?= $form->field($model, 'password', ['template'=>' <div class="input-group">{input}<span class="input-group-addon">
    <span class="glyphicon glyphicon-lock"></span></span></div>{error}'])->passwordInput(['placeholder'=>Yii::t('site', 'Password')]) ?>

                    <div class="form-group">
                        <?= Html::submitButton(Yii::t('site', 'Save'), ['class' => 'btn btn-primary btn-block']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
