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
            <?php $language = $item['iso_code'] === 'uk' ? 'ua' : $item['iso_code']; ?>
            <?php $language = $item['iso_code'] === 'en' ? 'us' : $language; ?>
            <?php echo Html::a('<span class="flag-icon flag-icon-' . $language . '"></span><span>' . $item['iso_code'] . '</span>', '/' . $item['iso_code']. Yii::$app->getRequest()->getLangUrl()) ?>
        <?php endif ?>
    <?php endforeach; ?>
<?php endif ?>