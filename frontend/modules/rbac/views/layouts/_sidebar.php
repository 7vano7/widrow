<?php

/* @var $this \yii\web\View */

$this->params['sidebar'] = [
    [
        'label' => Yii::t('access', 'Assignments'),
        'url' => ['assignment/index'],
    ],
    [
        'label' => Yii::t('access', 'Roles'),
        'url' => ['role/index'],
    ],
    [
        'label' => Yii::t('access', 'Permissions'),
        'url' => ['permission/index'],
    ],
    [
        'label' => Yii::t('access', 'Routes'),
        'url' => ['route/index'],
    ],
    [
        'label' => Yii::t('access', 'Rules'),
        'url' => ['rule/index'],
    ],
];

?>

<div class="rbac-menu">
    <table class="rbac-table">
        <tr>
            <td><a href="/rbac/"><?php echo Yii::t('access', 'Access rules') ?></a></td>
        </tr>
        <tr>
            <td><a href="/rbac/role/"><?php echo Yii::t('access', 'Roles') ?></a></td>
        </tr>
        <tr>
            <td><a href="/rbac/permission/"><?php echo Yii::t('access', 'Permissions') ?></a></td>
        </tr>
        <tr>
            <td><a href="/rbac/rule/"><?php echo Yii::t('access', 'Rules') ?></a></td>
        </tr>

    </table>

</div>
