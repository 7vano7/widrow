<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\modules\admin\models\User */

$this->title = Yii::t('admin', 'Profile') . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('admin', 'Profile');
?>

<div class="page-header">
    <h1>
        <?php echo Yii::t('admin', 'Profile'); ?>
    </h1>
</div>
<div class="box box-primary">
    <div class="box-header with-border">
        <h1 class="box-title">
            <?php echo Yii::t('admin', 'Profile'); ?>
        </h1>
    </div>
    <div class="box-body">
        <div class="user-update">
            <div class="user-form">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'username')->textInput() ?>
                <?= $form->field($model, 'password_hash')->passwordInput() ?>
                <?= $form->field($model, 'email')->textInput() ?>
                <?php if ($model->google_auth): ?>
                    <?php echo $form->field($model, 'google_auth')->textInput(['placeholder' => Yii::t('users', 'Google auth')]); ?>
                <?php else: ?>
                    <div>
                        <h2><?php Yii::t('users', 'Authenticator') ?></h2>
                        <div><img src="<?php echo $auth['qr_code'] ?>"></div>
                        <div><?php echo Yii::t('users', 'Google auth') . ': ' . $auth['auth'] ?></div>
                        <div><?php echo Yii::t('users', 'Google authenticator'); ?>
                            <?php echo $form->field($model, 'google_auth')->textInput(['placeholder' => Yii::t('users', 'Google auth')]); ?>
                        </div>
                    </div>
                <?php endif ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('admin', 'Save'), ['class' => 'btn btn-success']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
