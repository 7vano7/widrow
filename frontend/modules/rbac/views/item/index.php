<?php

use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider \yii\data\ArrayDataProvider */
/* @var $searchModel \yii2mod\rbac\models\search\AuthItemSearch */

$labels = $this->context->getLabels();
$this->title = Yii::t('access', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;
$this->render('/layouts/_sidebar');
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
            <?php if (Yii::$app->user->can('access.role.create')) {
                echo Html::a(Yii::t('access', 'Create ' . $labels['Item']), ['create'], ['class' => 'btn btn-success']);
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
                        'label' => Yii::t('access', 'Roles'),
                        'value' => function($model){
                            $roles = [];
                            $parents = Yii::$app->authManager->getParents($model->name);

                            if( !empty($parents) ){
                                foreach ($parents as $parent){
                                    $roles[] = $parent->name;
                                }
                            }

                            return implode(', ', $roles);
                        }
                    ],
                    [
                        'attribute' => 'ruleName',
                        'label' => Yii::t('access', 'Rule Name'),
                        'filter' => ArrayHelper::map(Yii::$app->getAuthManager()->getRules(), 'name', 'name'),
                        'filterInputOptions' => ['class' => 'form-control', 'prompt' => Yii::t('access', 'Select Rule')],
                    ],
                    [
                        'attribute' => 'description',
                        'format' => 'ntext',
                        'label' => Yii::t('access', 'Description'),
                    ],
                    [
                        'header' => Yii::t('access', 'Action'),
                        //'class' => 'yii\grid\ActionColumn',
                       // [
                            'class' => 'yii\grid\ActionColumn',
                            'template' => '{view} {update} {delete}',
                            'buttons' => [
                                'view' => function($url, $model) {
                                  if(Yii::$app->user->can('access.role.view'))
                                   {
                                        return Html::a('<span class="glyphicon glyphicon-eye-open">',
                                         Url::to(['view', 'id' => $model->name])
                                       );
                                    }
                                    return false;
                                },
                                'update' => function($url, $model) {
                                   if(Yii::$app->user->can('access.role.update'))
                                   {
                                        return Html::a('<span class="glyphicon glyphicon-pencil">',
                                            Url::to(['update', 'id' => $model->name])
                                        );
                                    }
                                    return false;
                                },
                                'delete' => function($url, $model) {
                                   if(Yii::$app->user->can('access.role.delete'))
                                   {
                                        return Html::a('<span class="glyphicon glyphicon-trash">',
                                            Url::to(['view', 'id' => $model->name])
                                        );
                                    }
                                    return false;
                                }
                            // ]
                        ],
                    ]
                ],
            ]); ?>

            <?php Pjax::end(); ?>
        </div>
    </div>
</div>
