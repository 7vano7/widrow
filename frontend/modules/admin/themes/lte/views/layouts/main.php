<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\MainTemplateAsset;
use frontend\widgets\LeftWidget;
use frontend\widgets\HeaderWidget;
use frontend\widgets\FooterWidget;


MainTemplateAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="hold-transition skin-blue sidebar-mini">
        <?php $this->beginBody() ?>
        <!-- Site wrapper -->
        <div class="wrapper">
            <header class="main-header">
                <?= HeaderWidget::widget(['user' => Yii::$app->user]) ?>
            </header>
            <aside class="main-sidebar">
                <?= LeftWidget::widget(['user' => Yii::$app->user]) ?>
            </aside>
            <div class="content-wrapper">
                <?php /*
                <section class="content-header">
                    <h1>
                        Blank page
                        <small>it all starts here</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Examples</a></li>
                        <li class="active">Blank page</li>
                    </ol>
                </section>
                */?>
                <section class="content">
                    <?= $content ?>
                </section>
            </div>
            <footer class="main-footer">
                <?= FooterWidget::widget(['user' => Yii::$app->user]) ?>
            </footer>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>