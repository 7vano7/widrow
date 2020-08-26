<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>
<section class="sidebar">
    <ul class="sidebar-menu" data-widget="tree">
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>

                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

            </li>




        <?php if(Yii::$app->user->can('offer.listview')): ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list-ul"></i>
                    <span>
                        <?php echo Yii::t('frontend', 'Offers');?>
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

            </li>
        <?php endif;?>

        <?php if(Yii::$app->user->can('ticket.listview')): ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-comment"></i>
                    <span>
                        <?php echo Yii::t('frontend', 'Tickets');?>
                    </span>
                    <?php $openTickets = \frontend\models\Ticket::getCountOpenTickets(Yii::$app->user->id, Yii::$app->user->can('ticket.control'));?>
                    <?php if( $openTickets ):?>
                        <span class="pull-right-container">
                            <small class="label pull-right bg-red">
                                <?php echo $openTickets;?>
                            </small>
                        </span>
                    <?php endif;?>
                </a>
                <ul class="treeview-menu">

                </ul>
            </li>
        <?php endif;?>
        <?php if (Yii::$app->user->can('country.listview') || Yii::$app->user->can('os.listview') || Yii::$app->user->can('traffic_type.listview') || Yii::$app->user->can('device.listview')): ?>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>
                        <?php echo Yii::t('frontend', 'Settings');?>
                    </span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">



                </ul>
            </li>
        <?php endif ?>
        <?php if(Yii::$app->user->can('history.listview')): ?>

        <?php endif;?>
    </ul>
</section>