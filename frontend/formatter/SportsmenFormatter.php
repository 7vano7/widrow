<?php

namespace frontend\formatter;


use yii\helpers\Html;
use frontend\components\FrontendFormatter;
use frontend\models\Sportsmen;
use Yii;

class SportsmenFormatter extends FrontendFormatter
{

    /*
     * Formatter email
     * @param $value string
     * @return string
     */
    public function asEmails($value)
    {
        $res = Yii::t('site','not set');
        if($value)
        {
            $res = Html::encode($value);
        }
        return $res;
    }

    /*
     * Formatter category
     * @param $data object
     * @return string
     */
    public function asCategory($data):string
    {
        $res = Yii::t('site','not set');
        if($data)
        {
            $category = $data->getCategory($data->category);
            if($category)
            {
                $res = $category;
            }
        }
        return $res;
    }

    /*
     * Formatter married
     * @param $value string
     * @return string
     */
    public function asMarried($value):string
    {
        $res = Yii::t('site','not set');
        $array = [
            Sportsmen::STATUS_NOT_MARRIED => Yii::t('site', 'Married'),
            Sportsmen::STATUS_MARRIED => Yii::t('site', 'Not married'),
        ];
        if($value)
        {
            $res = $array[$value];
        }
        return $res;
    }

    /*
     * Formatter growth
     * @param $value string
     * @return string
     */
    public function asGrowths($value):string
    {
        $res = Yii::t('site','not set');
        if($value)
        {
            $res = $value.' '.Yii::t('site', 'cm');
        }
        return $res;
    }

    /*
     * Formatter weight
     * @param $value string
     * @return string
     */
    public function asWeights($value):string
    {
        $res = Yii::t('site','not set');
        if($value)
        {
            $res = $value.' '.Yii::t('site', 'kg');
        }
        return $res;
    }


    /*
     * Formatter growth
     * @param $data object
     * @return string
     */
    public function asCoach($data):string
    {
        $res = Yii::t('site','not set');
        if($data->coach)
        {
            $res = '';
            foreach($data->coach as $item)
            {
                foreach($item->coach as $value)
                {
                    if($value->lang == Yii::$app->language)
                    {
                        $res .= $value->full_name.' ';
                    }
                }
            }
            if(!$res)
            {
                $res = Yii::t('site','not set language');
            }
        }
        return $res;
    }

    /*
     * Formatter school
     * @param $data object
     * @return string
     */
    public function asSchool($data):string
    {
        $res = Yii::t('site','not set');
        if($data->school)
        {
            $res = Yii::t('site','not set language');
            foreach($data->school as $item)
            {
                if($item->lang == Yii::$app->language)
                {
                    $res = Html::encode($item->name);
                }
            }
        }
        return $res;
    }

    /*
     * Formatter education
     * @param $value string
     * @return string
     */
    public function asStudy($value)
    {
        $res = Yii::t('site','not set');
        if($value)
        {
            $res = Html::encode($value);
        }
        return $res;
    }

    /*
     * Formatter city
     * @param $data object
     * @return string
     */
    public function asCity($data)
    {
        $res = Yii::t('site','not set');
        if($data->school)
        {
            $res = Yii::t('site','not set language');
            foreach($data->school as $item)
            {
                if($item->lang == Yii::$app->language)
                {
                    $res = Html::encode($item->city);
                }
            }
        }
        return $res;
    }

    /*
     * Formatter photo
     * @param $data object
     * @return string
     */
    public function asFiles($data):string
    {
        $res = Yii::t('site','not set');
        if($data->photos)
        {
            $res = '';
            foreach($data->photos as $file)
            {
                $res .= '<img src="'.$file->file.'" style="width:200px; margin: 5px">';
            }
        }
        return $res;
    }

}