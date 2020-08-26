<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="col-sm-12 site-error">

<?php if($exception->statusCode == 404):?>
    <?php echo Html::img(Yii::getAlias('@web').'/images/site/404.jpg')?>
<?php elseif ($exception->statusCode == 403): ?>
    <?php echo Html::img(Yii::getAlias('@web').'/images/site/403.png')?>
    <?php endif ?>
    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

</div>
