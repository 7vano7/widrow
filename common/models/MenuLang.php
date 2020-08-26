<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu_lang".
 *
 * @property int $id
 * @property string $menu_name
 * @property string $lang
 * @property int $menu_id
 * @property int $submenu_id
 * @property int $seo_title
 * @property int $seo_description
 * @property int $seo_keywords
 */
class MenuLang extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu_lang';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['menu_id', 'submenu_id'], 'integer'],
            [['menu_name', 'lang'], 'string', 'max' => 255],
            [['seo_title', 'seo_description', '$seo_keywords'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'menu_name' => 'Menu Name',
            'lang' => 'Lang',
            'menu_id' => 'Menu ID',
            'submenu_id' => 'Submenu ID',
        ];
    }
}
