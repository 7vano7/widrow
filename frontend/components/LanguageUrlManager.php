<?php
namespace frontend\components;

use yii\web\UrlManager;
use frontend\models\Language;

/**
 * Class LanguageUrlManager
 * @package frontend\components
 */
class LanguageUrlManager extends UrlManager
{
    public function createUrl($params)
    {
        if( isset($params['lang_id']) ){
            //Если указан идентефикатор языка, то делаем попытку найти язык в БД,
            //иначе работаем с языком по умолчанию
            $lang = Language::find()->where(
                ['iso_code'=>$params['lang_id']])->one();
            if( $lang === null ){
                $lang = Language::getDefaultLang();
            }

            unset($params['lang_id']);
        } else {
            //Если не указан параметр языка, то работаем с текущим языком
            $lang = Language::getCurrent();
        }
        $url = parent::createUrl($params);

        if($lang->iso_code == Language::getDefaultLang()->iso_code)
        {
            return $url;
        }
        else
        {
            return $url == '/' ? '/'.$lang->iso_code : '/'.$lang->iso_code.$url;
        }
    }
}