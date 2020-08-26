<?php

/* @var $this \yii\web\View */

/* @var $content string */

use yii\helpers\Html;
use frontend\assets\IAsset;
use frontend\components\MenuWidget;
use frontend\components\LanguageViewWidget;
use yii\helpers\Url;
use frontend\components\FooterWidget;

IAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/frontend/web/favicon.png" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
    <?= MenuWidget::widget() ?>
    <?= $content ?>
    <div id="scroller"><i class="glyphicon glyphicon-chevron-up"></i> </div>
    <footer class="col-sm-12 footer">
        <div class="col-sm-12">
            <hr>
            <div class="col-sm-3">
                <p class="title">&copy; <?= date('Y') ?> <?= Yii::t('site', 'deny material') ?></p>
            </div>
            <div class="col-sm-6 footer-list">
                <?php echo FooterWidget::widget(); ?>
            </div>
            <div class="col-sm-3">
                <div class="footer-lang">
                    <?php $language = Yii::$app->language === 'uk' ? 'ua' : (Yii::$app->language === 'en' ? 'us' : Yii::$app->language) ?>
                    <?php echo Html::a('<span class="flag-icon flag-icon-' . $language . '"></span><span>'
                        . Yii::$app->language . '</span>', '/'.$language . Yii::$app->getRequest()->getLangUrl()
                    ) ?>
                    <?php echo LanguageViewWidget::widget() ?>
                </div>
            </div>
        </div>

        <!--                <p class="created">--><? //= Yii::t('site', 'Created by') ?><!--</p>-->
    </footer>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
