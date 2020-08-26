<?php

namespace frontend\modules\admin\models;

use Yii;

class MenuLang extends \common\models\MenuLang
{
    public function rules()
    {
        return [
            [['menu_name', 'lang'], 'required'],
            [['menu_id', 'submenu_id'], 'integer'],
            [['menu_name', 'lang'], 'string', 'max' => 255],
            [['seo_title', 'seo_description', 'seo_keywords'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin','ID'),
            'menu_name' => Yii::t('menu','Menu Name'),
            'lang' => Yii::t('menu','Lang'),
            'menu_id' => Yii::t('menu','Menu ID'),
            'submenu_id' => Yii::t('menu','Submenu ID'),
            'seo_title'=>Yii::t('admin', 'Seo title'),
            'seo_description'=>Yii::t('admin', 'Seo description'),
            'seo_keywords'=>Yii::t('admin', 'Seo keywords'),
        ];
    }

    /*
    * Get relation Menu model
    * @return object
    */
    public function getSubmenu()
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
