<?php

namespace frontend\components;

use yii\web\UrlManager;
use frontend\models\Language;
use Yii;

class LanguageUrlManager extends UrlManager
{
    /**
     * @var bool whether to detect the app language from the HTTP headers (i.e.
     * browser settings).  Default is `true`.
     */
//    public $enableLanguageDetection = false;

    public function createUrl($params)
    {
        if (isset($params['lang_id'])) {
            //Если указан идентефикатор языка, то делаем попытку найти язык в БД,
            //иначе работаем с языком по умолчанию
            $lang = Language::find()->where(['iso_code' => $params['lang_id']])->one();
            if ($lang === null) {
                $lang = Language::getDefaultLang()->iso_code;
            }
            unset($params['lang_id']);
        } else {
            //Если не указан параметр языка, то работаем с текущим языком
            $lang = Language::getCurrent()->iso_code;
        }
        $url = parent::createUrl($params);

        if ($lang == Language::getDefaultLang()->iso_code) {
            return $url;
        } else {
            return $url == '/' ? '/' . $lang : '/' . $lang . $url;
        }
    }
}