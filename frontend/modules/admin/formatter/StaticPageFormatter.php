<?php

namespace frontend\modules\admin\formatter;

use frontend\modules\admin\models\StaticPageTranslation;
use yii\helpers\Html;
use frontend\components\FrontendFormatter;
use frontend\modules\admin\models\StaticPage;
use Yii;

/**
 * Class StaticPageFormatterFormatter
 * @package frontend\modules\admin\formatter
 */
class StaticPageFormatter extends FrontendFormatter
{
    /**
     * Formatter title
     * @param $data object
     * @return string
     */
    public function asTitle($data):string
    {
        $res = Yii::t('admin','not set');
        if($data->pageTranslation)
        {
            $lang = false;
            foreach($data->pageTranslation as $page)
            {
                if($page->lang == Yii::$app->language)
                {
                    $res = $page->title;
                    $lang = true;
                }
            }
            if(!$lang)
            {
                $res = '(not set on current language)';
            }
        }
        return $res;
    }

    /**
     * Formatter language
     * @param $data object
     * @return string
     */
    public function asLang($data):string
    {
        $res = Yii::t('admin','not set');
        $res = '<span class="flag-icon flag-icon-"'.$data->lang.'"></span><span> '.$data->lang.'</span>';
        if($data->lang == 'uk')
        {
            $res = '<span class="flag-icon flag-icon-ua"></span><span> '.$data->lang.'</span>';
        }
        if($data->lang == 'us')
        {
            $res = '<span class="flag-icon flag-icon-us"></span><span> '.$data->lang.'</span>';
        }
        return $res;
    }

    /**
     * Formatter status
     * @param $data object
     * @return string
     */
    public function asStatus($value):string
    {
        $new = new StaticPage();
        if($value == $new::STATUS_ACTIVE)
        {
            return Html::tag('span', Yii::t('static', $value), ['class' => 'label label-success']);
        }
        else
        {
            return Html::tag('span', Yii::t('static', $value), ['class' => 'label label-danger']);
        }
    }
}