<?php

use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var $pages array
 */
?>

<?php if ($pages): ?>
    <ul>
        <?php foreach ($pages as $item): ?>
            <li>
                <?php echo Html::a($item['title'], Url::toRoute('/static/'.$item['staticPage']['url'])) ?>
            </li>
        <?php endforeach ?>
    </ul>
<?php endif ?>