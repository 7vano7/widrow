<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\models\Language;

?>
<div class="title-site"><?php echo Html::a(Yii::t('site', 'FSLU'), Url::toRoute('/')) ?></div>
<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">
           Toggle navigation
        </span>
    <span class="laptop"><?php echo Yii::t('site', 'Menu') ?></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a>
<?php $languages = Language::findAll(['status' => Language::STATUS_ACTIVE]); ?>
<div class="btn-group langs pull-left" role="group">
    <button id="main-menu" type="button" class="btn btn-secondary dropdown-toggle"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php $code = Language::find()->where(['iso_code' => Yii::$app->language])->one()->iso_code ?>
        <?php if ($code === 'uk'): ?>
            <?php $code = 'ua' ?>
        <?php endif ?>
        <?php echo '<span class="flag-icon flag-icon-' . $code . '"></span><span class="span-down"><i class="fa fa-angle-down pull-right"></i></span>' ?>
    </button>
    <?php if ($languages): ?>
        <div class="dropdown-menu list-menu" aria-labelledby="main-menu">
            <?php foreach ($languages as $language): ?>
                <?php if ($language->iso_code != Yii::$app->language): ?>
                    <?php if ($language->iso_code === 'uk'): ?>
                        <?php $language->iso_code = 'ua'; ?>
                    <?php endif ?>
                    <a class="dropdown-item"
                       href="/<?php echo $language->main === 'active' ? (isset($_GET['id']) ? Yii::$app->requestedRoute . '?' . preg_replace('/^.*\?/', '', $_SERVER['REQUEST_URI']) : Yii::$app->requestedRoute) : $language->iso_code . Yii::$app->getRequest()->getLangUrl() ?>"><?php echo '<span class="flag-icon flag-icon-' . $language->iso_code . '"></span> ' . $language->name ?></a>
                <?php endif ?>
            <?php endforeach ?>
        </div>
    <?php endif ?>
</div>
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <?php if(Yii::$app->user->isGuest):?>
        <li class="dropdown user user-menu">
            <div class="pull-right">
            <?php echo Html::a(Yii::t('site', 'Sign in'), ['/site/login'], ['class' => 'btn btn-link logout']); ?>
            </div>
            <div class="pull-right">
                <?php echo Html::a(Yii::t('site', 'Sign up'), ['/site/signup'], ['class' => 'btn btn-link logout']); ?>
            </div>
        </li>
        <?php else :?>


        <li class="dropdown user user-menu">
            <div class="pull-right">
                <?php echo Yii::$app->user->identity->username;?>
            </div>
            <?php
            echo Html::beginForm(['/site/logout'], 'post');
            echo Html::submitButton(
                Yii::t('site', 'Logout') . ' <span class="glyphicon glyphicon-log-out"></span>',
                ['class' => 'btn btn-link logout']
            );
            echo Html::endForm();
            ?>
        </li>
        <?php endif ?>
    </ul>
</div>
<nav class="navbar navbar-static-top">
    <h2><?php echo Html::a(Yii::t('site', 'FSLU'), Url::toRoute('/')) ?></h2>
</nav>
