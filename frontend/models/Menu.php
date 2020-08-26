<?php

namespace frontend\models;

use Yii;

Class Menu extends \common\models\Menu
{

 	/**
     * Get relation MenuLang models
     * @return array
     */
    public function getMenuLang()
    {
        return $this->hasMany(MenuLang::className(), ['menu_id'=>'id']);
    }
}