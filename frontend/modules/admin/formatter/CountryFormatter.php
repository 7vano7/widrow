<?php

namespace frontend\modules\admin\formatter;


use frontend\modules\admin\models\Country;
use yii\helpers\Html;
use frontend\components\FrontendFormatter;
use Yii;

class CountryFormatter extends FrontendFormatter
{
    /**
     * Formatter language
     * @param $data object
     * @return string
     */
    public function asLang($data): string
    {
        if ($data->iso_code == 'uk') {
            $res = '<span class="flag-icon flag-icon-ua"></span><span> ' . $data->iso_code . '</span>';
        }
        elseif ($data->iso_code == 'en' || $data->iso_code == 'us') {
            $res = '<span class="flag-icon flag-icon-us"></span><span> ' . $data->iso_code . '</span>';
        }
        else
        {
            $res = '<span class="flag-icon flag-icon-'.$data->iso_code.'"></span><span> ' . $data->iso_code . '</span>';
        }
        return $res;
    }

}