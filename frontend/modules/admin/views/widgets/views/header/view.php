<?php

use yii\helpers\Url;
use yii\helpers\Html;
use frontend\modules\admin\models\Language;

?>
<a href="<?php echo Url::to('/'); ?>" class="logo">
    <span class="logo-mini"><b>A</b></span>
    <span class="logo-lg"><b> <?php echo Yii::t('admin', 'Admin-Archery') ?></b></span>
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
                <?= Html::a('<i class="fa fa-user"></i> ' . Html::encode(Yii::$app->user->identity->email), ['/admin/user/profile']) ?>
            </li>
            <li>
                <?php $languages = Language::findAll(['status' => Language::STATUS_ACTIVE]); ?>
                <div class="btn-group langs" role="group">
                    <button id="main-menu" type="button" class="btn btn-secondary dropdown-toggle"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo Language::find()->where(['iso_code' => Yii::$app->language])->one()->name; ?>
                    </button>
                    <?php if ($languages): ?>
                        <div class="dropdown-menu list-menu" aria-labelledby="main-menu">
                            <?php foreach ($languages as $language): ?>
                                <?php if ($language->iso_code != Yii::$app->language): ?>
                                    <a class="dropdown-item"
                                       href="/<?php echo $language->main === 'active' ? (isset($_GET['id']) ? Yii::$app->requestedRoute . '?' . preg_replace('/^.*\?/', '', $_SERVER['REQUEST_URI']) : Yii::$app->requestedRoute) : $language->iso_code . Yii::$app->getRequest()->getLangUrl() ?>"><?php echo $language->name ?></a>
                                <?php endif ?>
                            <?php endforeach ?>
                        </div>
                    <?php endif ?>
                </div>
            </li>
            <li class="dropdown user user-menu">
                <?php //echo Html::a(Yii::t('frontend', 'Logout'), ['site/logout'])?>
                <?php
                echo Html::beginForm(['/site/logout'], 'post');
                echo Html::submitButton(
                    Yii::t('admin', 'Logout') . ' <span class="glyphicon glyphicon-log-out"></span>',
                    ['class' => 'btn btn-link logout']
                );
                echo Html::endForm();
                ?>
            </li>
        </ul>
    </div>
</nav>
