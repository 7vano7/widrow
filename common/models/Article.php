<?php

namespace common\models;

use common\components\Date;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
* This is the model class for table "article".
 *
 * @property int $id
* @property string $created_at
* @property string $updated_at
* @property integer $category
* @property string $status
* @property string $image
* @property integer $top
* @property string $gif
* @property string $url
*/
class Article extends ActiveRecord
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_DISABLE = 'disable';
    public const IS_TOP = 1;
    public const NOT_TOP = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'article';
    }

    /**
     * {@inheritdoc}
     */
    public function rules():array
    {
        return [
            [['category', 'status', 'image', 'url', 'user_id'], 'required'],
            [['category', 'top', 'user_id'], 'integer'],
            [['status', 'image', 'gif', 'url'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels():array
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'status' => 'Status',
            'category' => 'Category',
            'image' => 'Image',
            'top' => 'Top',
            'user_id' => 'User',
            'gif' => 'Gif',
            'url' => 'Url',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors():array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => (new Date())->now(),
            ],
        ];
    }

}