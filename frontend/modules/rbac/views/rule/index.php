<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $searchModel yii2mod\rbac\models\search\BizRuleSearch */

$this->title = Yii::t('access', 'Rules');
$this->params['breadcrumbs'][] = $this->title;
//$this->render('/layouts/_sidebar');
?>

<div class="page-header">
    <h1><?php echo Yii::t('access', 'Access rules'); ?></h1>
</div>
<div class="box">
    <div class="box-header with-border">
        <h1 class="box-title">
            <h1><?php echo Html::encode($this->title); ?></h1>
        </h1>
        <p>
            <?php if (Yii::$app->user->can('access.rule.create')) {
                echo Html::a(Yii::t('access', 'Create Rule'), ['create'], ['class' => 'btn btn-success']);
            } ?>
        </p>
    </div>

    <div class="box-body">
        <?php echo $this->render('/layouts/_sidebar'); ?>
        <div class="assignment-index">

            <?php Pjax::begin(['timeout' => 5000]); ?>

            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'name',
                        'label' => Yii::t('access', 'Name'),
                    ],
                    [
                        'header' => Yii::t('access', 'Action'),
                        'class' => 'yii\grid\ActionColumn',
                    ],
                ],
            ]);
            ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>