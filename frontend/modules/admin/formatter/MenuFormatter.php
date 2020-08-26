<?php

namespace frontend\modules\admin\formatter;


use frontend\modules\admin\models\MenuLang;
use yii\helpers\Html;
use frontend\components\FrontendFormatter;
use frontend\modules\admin\models\Menu;
use Yii;

class MenuFormatter extends FrontendFormatter
{
    /**
     * Formatter name
     * @param $data object
     * @return string
     */
    public function asName($data):string
    {
        $res = Yii::t('admin','not set');
        if($data->menuLang)
        {
            $lang = false;
            foreach($data->menuLang as $menu)
            {
                if($menu->lang == Yii::$app->language)
                {
                    $res = $menu->menu_name;
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
     * Formatter title
     * @param $data object
     * @return string
     */
    public function asTitle($data): string
    {
        $res = Yii::t('admin','not set');
        if ($data) {
            $res = $data;
        }
        return $res;
    }

    /**
     * Formatter parent
     * @param $data object
     * @return string
     */
    public function asParent($data):string
    {
        $res = Yii::t('admin','not set');
        if($data->lang == Yii::$app->language && $data->submenu_id != false)
        {
            $name = MenuLang::find()->where(['menu_id'=>$data->submenu_id, 'lang'=>Yii::$app->language])->one();
            if($name)
            {
                $res = $name->menu_name;
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
        $new = new Menu;
        if($value == $new::STATUS_ACTIVE)
        {
            return Html::tag('span', Yii::t('menu', $value), ['class' => 'label label-success']);
        }
        else
        {
           return Html::tag('span', Yii::t('menu', $value), ['class' => 'label label-danger']);
        }
    }

    /**
     * Formatter image
     * @param $value string
     * @return string
     */
    public function asImages($value): string
    {
        return '<img src="' . $value. '" style="width:100px;">';
    }
}