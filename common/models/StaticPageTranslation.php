<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "static_page_translation".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $lang
 * @property int $static_page_id
 */
class StaticPageTranslation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'static_page_translation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['static_page_id',], 'integer'],
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
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'lang' => 'Language',
            'static_page_id' => 'Static page ID',
        ];
    }
}
