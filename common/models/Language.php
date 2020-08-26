<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "language".
 *
 * @property int $id
 * @property string $name
 * @property string $iso_code
 * @property string $status
 * @property string $main
 */
class Language extends \yii\db\ActiveRecord
{
    public const STATUS_ACTIVE = 'active';
    public const STATUS_DISABLE = 'disable';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'language';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'iso_code', 'status', 'main'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'iso_code' => 'Iso Code',
            'status' => 'Status',
            'main' => 'Main',
        ];
    }

    static $current = null;

//Get current language object
    static function getCurrent()
    {
        if (self::$current === null) {
            self::$current = self::getDefaultLang();
        }
        return self::$current;
    }

// Set current language object and locale
    static function setCurrent($url = null)
    {
        $language = self::getLangByUrl($url);
        self::$current = ($language === null) ? self::getDefaultLang() : $language;
        Yii::$app->language = self::$current->iso_code;
    }

//Get default language object
    static function getDefaultLang()
    {
        return Language::find()->where('`main` = :default', [':default' => 'active'])->one();
    }

// Get default language object by index
    static function getLangByUrl($url = null)
    {
        if ($url === null) {
            return null;
        } else {
            $language = Language::find()->where(['iso_code' => $url, 'status'=>self::STATUS_ACTIVE])->one();
            if ($language === null) {
                return null;
            } else {
                return $language;
            }
        }
    }
}
