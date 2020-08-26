<?php

namespace common\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "article_translation".
 *
 * @property int $id
 * @property integer $article_id
 * @property string $title
 * @property string $short_desc
 * @property string $content
 * @property string $lang
 * @property string $seo_title
 * @property string $seo_description
 * @property string $seo_keywords
 */
class ArticleTranslation extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article_translation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['article_id', 'title', 'lang',  'short_desc', 'content'], 'required'],
            [['title', 'short_desc', 'content','seo_title', 'seo_description', 'seo_keywords'], 'string'],
            ['content', 'validateContent'],
        ];
    }

    /**
     * validate content
     */
    public function validateContent($attribute, $params, $validator) {
        if(preg_match('/<iframe>/', $this->$attribute)) {
            $this->$attribute = preg_replace('/<p>/', '', $this->$attribute);
            $this->$attribute = preg_replace('/<\/p>/', '', $this->$attribute);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels():array
    {
        return [
            'id' => 'ID',
            'article_id' => 'Article',
            'title' => 'Title',
            'short_desc' => 'Short description',
            'content' => 'Content',
            'lang' => 'Language',
            'seo_title' => 'Seo title',
            'seo_description' => 'Seo description',
            'seo_keywords' => 'Seo keywords',
        ];
    }

}