<?php

use yii\helpers\Html;

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main col-sm-12">
    <div class="title">
        <h1><?php echo Html::encode(Yii::t('site', 'Contact')); ?></h1>
    </div>
    <div class="col-sm-7 contact">
        <div class="col-sm-10">
            <table class="table table-responsive table-contact">
                <tr>
                    <td>
                        <span class="glyphicon glyphicon-envelope"> </span>
                    </td>
                    <td>
                        <a href="mailto:ukrainianarcheryfederation@gmail.com">ukrainianarcheryfederation@gmail.com</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="glyphicon glyphicon-earphone"> </span>
                    </td>
                    <td>
                        +38 044 289 14 75
                    </td>
                </tr>
                <tr>
                    <td>
                        <span class="glyphicon glyphicon-road"> </span>
                    </td>
                    <td>
                        <?php echo Yii::t('site', 'Address to'); ?>
                    </td>
                </tr>
            </table>
            <div class="title">
                <h5>
                    <?php echo Yii::t('site', 'Social networks')?>
                </h5>
                <div>
                    <a class="btn btn-social-icon btn-facebook" href=""><i class="fa fa-facebook"></i> </a>
                    <a class="btn btn-social-icon btn-twitter" href=""><i class="fa fa-twitter"></i> </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-5 contact-image">
        <img src="<?=Yii::getAlias('@web')?>/images/site/fslu.jpg">
    </div>
    <div class="col-sm-12 map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2541.329610196145!2d30.517559951488533!3d50.43496089626091!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cefd80c8eb45%3A0xa532abdb83df92da!2z0LLRg9C70LjRhtGPINCV0YHQv9C70LDQvdCw0LTQvdCwLCA0Miwg0JrQuNGX0LIsIDAyMDAw!5e0!3m2!1suk!2sua!4v1539093080289"
                frameborder="0" style="border:0" allowfullscreen></iframe>
    </div>
</div>
