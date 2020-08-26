<?php

namespace frontend\models;

use Yii;

/**
 * Class StaticPageTranslation
 * @package frontend\models
 */
Class StaticPageTranslation extends \common\models\StaticPageTranslation
{

    /*
         * Get relation StaticPage model
         * @params mixed
         * @return object
         */
    public function getStaticPage()
    {
        return $this->hasOne(StaticPage::className(), ['id'=>'static_page_id']);
    }
}
