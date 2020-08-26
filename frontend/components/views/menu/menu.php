<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $menu array
 */
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <form class="navbar-form search-form" method="get" action="<?php echo Url::toRoute('/search')?>"
                  role="search">
                <a class="navbar-brand" href="<?php echo Url::toRoute(Yii::$app->getHomeUrl()) ?>">
                    <span class="logo-small"> <img src="<?php echo Yii::getAlias('@web')?>/images/site/logo.png"></span>
                    <span class="logo-big"><?php echo Html::img(Yii::getAlias('@web').'/images/site/vidrow.png')
                        ?></span>
                </a>
                <div class="form-group">
                    <input type="text" class="form-control" name="id" placeholder="<?php echo Yii::t('site', 'Search')
                    ?>">
                </div>
                <input type="submit" id="search-button" class="vcenter" value="">
                <a href="#" class="close"><?php echo Html::img(Yii::getAlias('@web').'/images/site/close.png')?></a>
            </form>

            <ul class="nav navbar-nav menu">
                <li><a class="logo" href="<?php echo Url::toRoute(Yii::$app->getHomeUrl()) ?>">
                        <span class="logo-small"> <img src="<?php echo Yii::getAlias('@web')?>/images/site/logo.png"></span>
                        <span class="logo-big"><?php echo Html::img(Yii::getAlias('@web').'/images/site/vidrow.png')
                            ?></span>
                    </a>
                </li>
                <?php if ($menu): ?>
                    <?php foreach ($menu as $item): ?>
                        <?php $url = trim(trim($item['url'][0], '/'), '/#'); ?>
                        <li class="<?php if (array_key_exists('items', $item)) {
                            echo 'dropdown';
                        } ?><?php if
                        (preg_match("#$url#", $_SERVER['REQUEST_URI'])) {
                            echo 'active';
                        } ?>">

                            <?= array_key_exists('items', $item) ? Html::a($item['label'] . '<span class="caret"></span>', '#',
                                ['class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'role' => 'button', 'aria-haspopup' => 'true', 'aria-expanded' => 'false']) :
                                Html::a
                                ($item['label'], Url::toRoute('/category/'.$item['url'][0])) ?>
                            <?php if (array_key_exists('items', $item)): ?>
                                <ul class="dropdown-menu">
                                    <?php foreach ($item['items'] as $data): ?>
                                        <?php $uri = trim(trim($data['url'][0], '/'), '/#');
                                        if (preg_match('/=/', $uri))
                                            $uri = trim(stristr($uri, '=', false), '='); ?>
                                    <?php endforeach; ?>
                                    <li <?php if (preg_match("#$uri#", $_SERVER['REQUEST_URI'])) {
                                        echo 'class="active"';
                                    } ?>>
                                        <?php Html::a($data['label'], Url::toRoute('/category'.$data['url'])) ?>
                                    </li>
                                </ul>
                            <?php endif ?>
                        </li>
                    <?php endforeach ?>
                <?php endif ?>
                <li><?php echo Html::a(Html::img(Yii::getAlias('@web').'/images/site/search12.png'), '', ['class'=>'search-view'])?></li>
            </ul>
        </div>
    </div>
</nav>