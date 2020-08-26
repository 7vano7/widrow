<?php

namespace frontend\modules\admin\models;

use Yii;

class ArticleTranslation extends \common\models\ArticleTranslation
{

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['article_id', 'title', 'lang', 'short_desc', 'content'], 'required'],
            [['title', 'short_desc', 'content', 'seo_title', 'seo_description', 'seo_keywords'], 'string'],
            [['title', 'seo_title'], 'string', 'max'=>255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels():array
    {
        return [
            'id' => 'ID',
            'article_id' => Yii::t('article','Article'),
            'lang'=>Yii::t('article', 'Language'),
            'content'=>Yii::t('article', 'Content'),
            'title'=>Yii::t('article', 'Title'),
            'short_desc'=>Yii::t('article', 'Short description'),
            'seo_title'=>Yii::t('admin', 'Seo title'),
            'seo_description'=>Yii::t('admin', 'Seo description'),
            'seo_keywords'=>Yii::t('admin', 'Seo keywords'),
        ];
    }

    /*
     * Get relation Language model
     * @params mixed
     * @return object
     */
    public function getLanguage()
    {
        return $this->hasOne(Language::className(), ['iso_code'=>'lang']);
    }
}
