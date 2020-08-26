<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\LoginForm */

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\bootstrap\ActiveForm;
use yii\widgets\ActiveForm;

?>
<div class="main col-sm-12">

    <div class="site-login">

        <div class="login-box-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="title">
                        <h1><?php echo Html::encode(Yii::t('site', 'Login')) ?></h1>
                    </div>
                    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                    <?php if (Yii::$app->cache->exists('authenticate')): ?>
                        <?= $form->field($model, 'google_auth')->textInput(['autofocus' => true]) ?>
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('site','Login'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                        </div>
                    <?php else : ?>

                        <?= $form->field($model, 'email', ['template'=>' <div class="input-group">{input}<span class="input-group-addon">
    <span class="glyphicon glyphicon-envelope"></span></span></div>{error}'])->textInput(['placeholder'=>Yii::t('site', 'Email')]) ?>

                        <?= $form->field($model, 'password', ['template'=>' <div class="input-group">{input}<span class="input-group-addon">
    <span class="glyphicon glyphicon-lock"></span></span></div>{error}'])->passwordInput(['placeholder'=>Yii::t('site', 'Password')]) ?>

                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <div style="margin:1em 0">
                            <?= Html::a(Yii::t('site', 'Forgot password'), ['site/request-password-reset']) ?>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton(Yii::t('site','Login'), ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
                        </div>
                        <div class="social-auth-links text-center">
                            <p>- <?php echo Yii::t('site', 'OR')?> -</p>
                            <a href="<?php echo Url::to('/site/auth?authclient=facebook')?>" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i>
                                <?php echo Yii::t('site', 'Sign in facebook')?></a></div>
                    <?php endif ?>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
