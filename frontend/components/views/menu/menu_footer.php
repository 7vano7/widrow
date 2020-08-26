<?php

use yii\helpers\Html;

?>

<?php if ($menu): ?>
    <ul class="sidebar-menu" data-widget="tree">
        <?php foreach ($menu as $item): ?>
            <?php if (isset($item['url'])): ?>
                <?php $url = trim(trim($item['url'][0], '/'), '/#'); ?>
                <?php if(preg_match('/=/', $url))
                    $url = trim(stristr($url, '=', false), '='); ?>
                <li class="<?php if (preg_match("#$url#", $_SERVER['REQUEST_URI'])) {
                    echo 'active';
                } ?>">

                <?= Html::a(
                    '<span>' . $item['label'] . '</span>',
                    $item['url']
                ) ?></li>
            <?php else: ?>
<!--                <li> <div class="name_category"><span>--><?php //echo $item['label']; ?><!--</span></div></li>-->
            <?php endif ?>
            
        <?php endforeach; ?>
    </ul>
<?php endif ?>