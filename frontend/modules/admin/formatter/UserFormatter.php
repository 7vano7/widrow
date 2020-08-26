<?php

namespace frontend\modules\admin\formatter;


use yii\helpers\Html;
use frontend\components\FrontendFormatter;
use frontend\modules\admin\models\User;
use Yii;

class UserFormatter extends FrontendFormatter
{
    /**
     * Formatter role
     * @param $value string
     * @return string
     */
    public function asRole($value):string
    {
        return Yii::t('users', $value);
    }

    /**
     * Formatter active
     * @param $value string
     * @return string
     */
    public function asActive($value):string
    {
        $model = new User;
        $status = $model->getActivate($value);
        if($value == $model::ACTIVE_SUCCESS)
            return Html::tag('span', Yii::t('news', $status), ['class' => 'label label-success']);
        return Html::tag('span', Yii::t('news', $status), ['class' => 'label label-danger']);
    }

    /**
     * Formatter status
     * @param $value string
     * @return string
     */
    public function asStatus($value):string
    {
        $model = new User;
        $status = $model->getStatuses($value);
        if($value == $model::STATUS_ACTIVE)
            return Html::tag('span', Yii::t('news', $status), ['class' => 'label label-success']);
        return Html::tag('span', Yii::t('news', $status), ['class' => 'label label-danger']);
    }
}