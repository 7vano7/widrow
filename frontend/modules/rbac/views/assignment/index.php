<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;


/* @var $this \yii\web\View */
/* @var $gridViewColumns array */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $searchModel \yii2mod\rbac\models\search\AssignmentSearch */
//echo "<pre>";print_r(Yii::$app->i18n);die;
$this->title = Yii::t('access', 'Assignments');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="page-header">
    <h1><?php echo Yii::t('access', 'Access rules'); ?></h1>
</div>
<div class="box">
    <div class="box-header with-border">
        <h1 class="box-title">
            <h1><?php echo Html::encode($this->title); ?></h1>
        </h1>
    </div>

    <div class="box-body">
        <?php echo $this->render('/layouts/_sidebar'); ?>
        <div class="assignment-index">

            <?php Pjax::begin(['timeout' => 5000]); ?>

            <?php echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => ArrayHelper::merge($gridViewColumns, [
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'template' => '{view}',
                        'buttons'=>[
                            'view'=> function ($url, $model)
                            {
                               if(Yii::$app->user->can('access.assignment.listview'))
                               {
                                    return Html::a('<span class="glyphicon glyphicon-eye-open">',
                                        Url::to(['view', 'id' => $model->id]));
                               }
                               return false;
                            },
                        ],
                    ],
                ]),
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>

