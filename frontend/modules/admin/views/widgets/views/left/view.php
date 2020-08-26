<?php

use frontend\modules\admin\models\User;
use yii\helpers\Html;

?>
<section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
        <?php if (\Yii::$app->user->can(User::ROLE_ADMIN)): ?>
            <li class="treeview <?php if (preg_match('/(admin\/country|rbac|admin\/user|admin\/language)/i', $_SERVER['REQUEST_URI'])) { ?> active <?php } ?>">
                <a href="#">
                    <i class="glyphicon glyphicon-cog"></i>
                    <span>
<?php echo Yii::t('admin', 'System'); ?>
</span>
                    <span class="pull-right-container">
<i class="fa fa-angle-left pull-right"></i>
</span>
                </a>
                <ul class="treeview-menu">
                    <?php if (\Yii::$app->user->can(User::ROLE_ADMIN)): ?>
                        <li <?php if (preg_match('/admin\/user/i', $_SERVER['REQUEST_URI'])) { ?> class="active" <?php } ?>>
                            <?= Html::a(
                                '<i class="glyphicon glyphicon-user"></i><span>' . Yii::t('admin', 'Users') . '</span>',
                                ['/admin/user']
                            ) ?>
                        </li>
                    <?php endif ?>
                    <?php if (\Yii::$app->user->can(User::ROLE_ADMIN)): ?>
                        <li <?php if (preg_match('/admin\/language/i', $_SERVER['REQUEST_URI'])) { ?> class="active" <?php } ?>>
                            <?= Html::a(
                                '<i class="glyphicon glyphicon-tasks"></i><span>' . Yii::t('admin', 'Language') . '</span>',
                                ['/admin/language']
                            ) ?>
                        </li>
                    <?php endif ?>
                    <?php if (\Yii::$app->user->can(User::ROLE_ADMIN)): ?>
                        <li <?php if (preg_match('/admin\/country/i', $_SERVER['REQUEST_URI'])) { ?> class="active" <?php } ?>>
                            <?= Html::a(
                                '<i class="glyphicon glyphicon-th-list"></i><span>' . Yii::t('admin', 'Country') . '</span>',
                                ['/admin/country']
                            ) ?>
                        </li>
                    <?php endif ?>
                    <?php if (false): ?>
                        <?php if (\Yii::$app->user->can(User::ROLE_ADMIN)): ?>
                            <li <?php if (preg_match('/rbac/i', $_SERVER['REQUEST_URI'])) { ?> class="active" <?php } ?>>
                                <?= Html::a(
                                    '<i class="glyphicon glyphicon-folder-open"></i><span>' . Yii::t('admin', 'Rules') . '</span>',
                                    ['/rbac']
                                ) ?>
                            </li>
                        <?php endif ?>
                    <?php endif ?>
                </ul>
            </li>
        <?php endif ?>
        <?php if (\Yii::$app->user->can(User::ROLE_MANAGER)): ?>
            <li <?php if (preg_match('/admin\/menu/i', $_SERVER['REQUEST_URI'])) { ?> class="active" <?php } ?>>
                <?= Html::a(
                    '<i class="glyphicon glyphicon-th-list"></i><span>' . Yii::t('admin', 'Menu') . '</span>',
                    ['/admin/menu']
                ) ?>
            </li>
        <?php endif ?>
        <?php if (\Yii::$app->user->can(User::ROLE_MANAGER)): ?>
            <li class="treeview <?php if (preg_match('/(admin\/static-page)/i', $_SERVER['REQUEST_URI'])) { ?> active <?php } ?>">
                <a href="#">
                    <i class="glyphicon glyphicon-cog"></i>
                    <span>
                        <?php echo Yii::t('admin', 'Static'); ?>
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <?php if (\Yii::$app->user->can(User::ROLE_MANAGER)): ?>
                        <li <?php if (preg_match('/admin\/static-page\/main/i', $_SERVER['REQUEST_URI'])) { ?>
                            class="active" <?php } ?> >
                            <?= Html::a(
                                '<i class="glyphicon glyphicon-th-large"></i><span>' . Yii::t('admin', 'Main') . '</span>',
                                ['/admin/static-page/main']
                            ) ?>
                        </li>
                    <?php endif ?>
                    <?php if (\Yii::$app->user->can(User::ROLE_MANAGER)): ?>
                        <li <?php if (preg_match('/admin\/static-page/i', $_SERVER['REQUEST_URI'])) { ?> class="active" <?php } ?> >
                            <?= Html::a(
                                '<i class="glyphicon glyphicon-th-large"></i><span>' . Yii::t('admin', 'Static') . '</span>',
                                ['/admin/static-page']
                            ) ?>
                        </li>
                    <?php endif ?>
                </ul>
            </li>
        <?php endif ?>
        <?php if (\Yii::$app->user->can(User::ROLE_MANAGER)): ?>
            <li <?php if (preg_match('/admin\/article/i', $_SERVER['REQUEST_URI'])) { ?> class="active" <?php } ?> >
                <?= Html::a(
                    '<i class="glyphicon glyphicon-book"></i><span>' . Yii::t('admin', 'Article') . '</span>',
                    ['/admin/article']
                ) ?>
            </li>
        <?php endif ?>
        <?php if (\Yii::$app->user->can(User::ROLE_MANAGER)): ?>
            <li <?php if (preg_match('/admin\/youtube/i', $_SERVER['REQUEST_URI'])) { ?> class="active" <?php } ?> >
                <?= Html::a(
                    '<i class="glyphicon glyphicon-film"></i><span>' . Yii::t('admin', 'Youtube') . '</span>',
                    ['/admin/youtube']
                ) ?>
            </li>
        <?php endif ?>
    </ul>
</section>
