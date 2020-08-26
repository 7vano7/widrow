<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $languages array
 */
?>

<?php if ($languages): ?>
    <?php foreach ($languages as $item): ?>
        <?php if ($item['iso_code'] != Yii::$app->language): ?>
<<<<<<< HEAD
            <?php $language = $item['iso_code'] === 'uk' ? 'ua' : $item['iso_code']; ?>
            <?php $language = $item['iso_code'] === 'en' ? 'us' : $language; ?>
            <?php echo Html::a('<span class="flag-icon flag-icon-' . $language . '"></span><span>' . $item['iso_code'] . '</span>', '/' . $item['iso_code']. Yii::$app->getRequest()->getLangUrl()) ?>
=======
            <?php $language = $item['iso_code'] == 'uk' ? 'ua' : ($item['iso_code'] == 'en' ? 'us' : $item['iso_code']) ?>
            <?php echo Html::a('<span class="flag-icon flag-icon-' . $item['iso_code'] . '"></span><span>' . $item['iso_code'] . '</span>', '/' . $item['iso_code']. Yii::$app->getRequest()->getLangUrl()) ?>
>>>>>>> 994e9fc5fa172c448007b8308705f1b7058d3c97
        <?php endif ?>
    <?php endforeach; ?>
<?php endif ?>