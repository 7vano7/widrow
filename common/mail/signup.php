<div class="container">
    <h3><?php echo Yii::t('mail','successReg');?><?=$_SERVER['SERVER_NAME'];?></h3>
    <p><?php echo Yii::t('mail','login');?> <?php echo $session->username?></p>

    <p><?php echo Yii::t('mail','password');?><?php echo $session->password_hash?></p>
    <p>Email: <?php echo $session->email?></p>
    <?php if(!$session->google_auth):?>
        <p><?php echo Yii::t('mail','activate');?><?=$_SERVER['SERVER_NAME'];?>/site/active?hash=<?=$session->auth_key;?></p>
    <?php endif ?>
    <br><br>
    <p><?php echo Yii::t('mail','administration');?></p>
</div>