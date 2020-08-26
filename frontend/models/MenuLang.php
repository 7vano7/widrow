<?php

namespace frontend\models;

use Yii;

class MenuLang extends \common\models\MenuLang
{
    /*
    * Get relation Menu model
    * @return object
    */
    public function getSubmenu()
    {
        return $this->hasOne(Menu::className(), ['id'=>'menu_id']);
    }

    /*
    * Get relation Menu model
    * @return object
    */
    public function getMenu()
    {
        return $this->hasOne(Menu::className(), ['id'=>'menu_id']);
    }

    /*
   * Get relation Language model
   * @return object
   */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['iso_code'=>'lang']);
    }
}
