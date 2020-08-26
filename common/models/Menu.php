<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property int $id
 * @property string $status
 * @property string $image
 * @property integer $is_menu
 */
class Menu extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_DISABLE = 'disable';

    public const MENU_TRUE = 1;
    public const MENU_FALSE = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status', 'url', 'image'], 'string', 'max' => 255],
            [['position', 'is_menu'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'url'=>'url',
            'position'=>'position',
            'image'=>'image',
        ];
    }
}
