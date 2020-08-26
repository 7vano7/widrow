<?php

use yii\helpers\Html;
use yii\helpers\Json;
use frontend\modules\rbac\RbacAsset;

RbacAsset::register($this);

/* @var $this yii\web\View */
/* @var $model \yii2mod\rbac\models\AssignmentModel */
/* @var $usernameField string */

$userName = $model->user->{$usernameField};
$this->title = Yii::t('access', 'Assignment : {0}', $userName);
$this->params['breadcrumbs'][] = ['label' => Yii::t('yii2mod.rbac', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $userName;
$this->render('/layouts/_sidebar');
?>
<div class="box">
    <div class="box-header with-border">
        <h1 class="box-title">
            <h1><?php echo Html::encode($this->title); ?></h1>
        </h1>
    </div>

    <div class="box-body">
        <?php echo $this->render('/layouts/_sidebar'); ?>
        <div class="assignment-index">

            <?php echo $this->render('../_dualListBox', [
                'opts' => Json::htmlEncode([
                    'items' => $model->getItems(),
                ]),
                'assignUrl' => ['assign', 'id' => $model->userId],
                'removeUrl' => ['remove', 'id' => $model->userId],
            ]); ?>
        </div>
    </div>
</div>

