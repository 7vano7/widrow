<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "static_page".
 *
 * @property int $id
 * @property string $url
 * @property string $status
 */
class StaticPage extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_DISABLE = 'disable';

    public const POSITION_MAIN = 1;
    public const POSITION_FOOTER = 2;

    /**
     * {@inheritdoc}
     */
    public
    static function tableName()
    {
        return 'static_page';
    }

    /**
     * {@inheritdoc}
     */
    public
    function rules()
    {
        return [
            [['url', 'status'], 'string', 'max' => 255],
            [['file'], 'string'],
            [['position'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public
    function attributeLabels()
    {
        return [
            'id' => 'ID',
            'url' => 'Url',
            'status' => 'Status',
        ];
    }
}
