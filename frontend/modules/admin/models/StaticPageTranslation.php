<?php

namespace frontend\modules\admin\models;

use Yii;

/**
 * Class StaticPageTranslation
 * @package frontend\modules\admin\models
 */
class StaticPageTranslation extends \common\models\StaticPageTranslation
{
    public function rules()
    {
        return [
            [['title', 'lang'], 'required'],
            [['static_page_id'], 'integer'],
            [['title', 'lang'], 'string', 'max' => 255],
            [['content'], 'string'],
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
            'title' => Yii::t('static','Title'),
            'lang' => Yii::t('static','Language'),
            'content' => Yii::t('static','Content'),
            'static_page_id' => Yii::t('static','Static page ID'),
            'seo_title'=>Yii::t('admin', 'Seo title'),
            'seo_description'=>Yii::t('admin', 'Seo description'),
            'seo_keywords'=>Yii::t('admin', 'Seo keywords'),
        ];
    }

    /*
    * Get relation StaticPage model
    * @return object
    */
    public function getSubmenu()
    {
        return $this->hasOne(StaticPage::className(), ['id'=>'menu_id']);
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
