<?php
use yii\helpers\Url;
use yii\helpers\Html;
use frontend\modules\admin\models\User;
?>
<a href="<?php echo Url::to('/');?>" class="logo">
    <span class="logo-mini"><b>T</b></span>
    <span class="logo-lg"><b> Terraleads.mobi</b></span>
</a>
<nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">
           Toggle navigation
        </span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </a>

    <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li>
                <?= Html::a('<i class="fa fa-user"></i> '.Html::encode('user'), ['/profile'])?>
            </li>
            <?php if( Yii::$app->user->can(User::ROLE_ADMIN) ):?>
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-exchange"></i>
                    </a>
                    <div class="dropdown-menu">
                        <div class="box-body">
                            <div class="col-sm-12">
                                <?php echo Yii::t('frontend', 'Switch user');?>
                            </div>

                            <?= Html::beginForm(['user/switch'], 'get', ['role' => 'form', 'id' => 'switch-user-form']) ?>
                                <div class="switch-user-input col-sm-8">
                                    <?= Html::input('text', 'id', '', ['class' => 'form-control', 'placeholder' => Yii::t('frontend', 'User ID')]) ?>
                                </div>
                                <div class="switch-user-button col-sm-4">
                                    <?= Html::submitButton('<i class="fa fa-check"></i>', ['class' => 'btn btn-success']) ?>
                                </div>
                            <?= Html::endForm() ?>

                            <?php if( Yii::$app->session->get('user.base_user_id') !== null  ):?>
                                <div class="col-sm-12">
                                    <?= Html::a(Yii::t('frontend', 'Back to original account'), ['user/switch', 'id' => Yii::$app->session->get('user.base_user_id')])?>
                                </div>
                            <?php endif;?>
                        </div>
                    </div>
                </li>
            <?php endif;?>

            <li class="dropdown user user-menu">
                <?php //echo Html::a(Yii::t('frontend', 'Logout'), ['site/logout'])?>
                <?php
                echo Html::beginForm(['/site/logout'], 'post');
                echo Html::submitButton(
                    'Logout'.' <span class="glyphicon glyphicon-log-out"></span>',
                    ['class' => 'btn btn-link logout']
                );
                echo Html::endForm();
                ?>
                <?php /*
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="../../dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
                    <span class="hidden-xs">Alexander Pierce</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="user-header">
                        <img src="../../dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                        <p>
                            Alexander Pierce - Web Developer
                            <small>Member since Nov. 2012</small>
                        </p>
                    </li>
                    <li class="user-body">
                        <div class="row">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </div>
                    </li>
                    <li class="user-footer">
                        <div class="pull-left">
                            <a href="#" class="btn btn-default btn-flat">Profile</a>
                        </div>
                        <div class="pull-right">
                            <a href="#" class="btn btn-default btn-flat">Sign out</a>
                        </div>
                    </li>
                </ul>
                */?>
            </li>
        </ul>
    </div>
</nav>
