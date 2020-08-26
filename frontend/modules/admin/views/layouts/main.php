<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use frontend\assets\MainTemplateAsset;
use frontend\modules\admin\widgets\LeftWidget;
use frontend\modules\admin\widgets\HeaderWidget;
use frontend\modules\admin\widgets\FooterWidget;

MainTemplateAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" href="/frontend/web/favicon.png" type="image/x-icon">
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
                <section class="content">
                    <?php if(Yii::$app->session->hasFlash('saved')):?>
                        <div class="alert alert-success" role="alert"><?php echo Yii::$app->session->getFlash('saved') ?></div>
                    <?php elseif(Yii::$app->session->hasFlash('delete')):?>
                        <div class="alert alert-danger" role="alert"><?php echo Yii::$app->session->getFlash('delete') ?></div>
                    <?php endif ?>
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