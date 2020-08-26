<?php

namespace frontend\modules\admin\formatter;


use frontend\modules\admin\models\Language;
use yii\helpers\Html;
use frontend\components\FrontendFormatter;
use Yii;

class LanguageFormatter extends FrontendFormatter
{
    /**
     * Formatter language
     * @param $data object
     * @return string
     */
    public function asLang($data): string
    {
        $res = '<span class="flag-icon flag-icon-'.$data->iso_code.'"></span><span> ' . $data->iso_code . '</span>';
        if ($data->iso_code == 'uk') {
            $res = '<span class="flag-icon flag-icon-ua"></span><span> ' . $data->iso_code . '</span>';
        }
        if ($data->iso_code == 'en') {
            $res = '<span class="flag-icon flag-icon-us"></span><span> ' . $data->iso_code . '</span>';
        }

        return $res;
    }

    /**
     * Formatter status
     * @param $value string
     * @return string
     */
    public function asStatus($value):string
    {
        $new = new Language;
        if($value == $new::STATUS_ACTIVE)
        {
            return Html::tag('span', Yii::t('language', $value), ['class' => 'label label-success']);
        }
        else
        {
            return Html::tag('span', Yii::t('language', $value), ['class' => 'label label-danger']);
        }

    }

    /**
     * Formatter main language
     * @param $value string
     * @return string
     */
    public function asMain($value):string
    {
        $new = new Language;
        if($value == $new::STATUS_ACTIVE)
        {
            return Html::tag('span', Yii::t('language', 'main'), ['class' => 'label label-success']);
        }
        else
        {
            return Html::tag('span', Yii::t('language', 'not main'), ['class' => 'label label-danger']);
        }
    }
}