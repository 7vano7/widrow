<?php

namespace frontend\modules\admin\models;

use Yii;

class Language extends \common\models\Language
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'iso_code', 'status'], 'required'],
            ['status', 'default', 'value'=>self::STATUS_ACTIVE],
            ['main', 'default', 'value'=>self::STATUS_DISABLE],
            [['name', 'iso_code', 'status', 'main'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin','ID'),
            'name' => Yii::t('language','Name'),
            'iso_code' => Yii::t('language','Iso Code'),
            'status' => Yii::t('language','Status'),
            'main' => Yii::t('language','Main'),
        ];
    }

    /*
     * Get list of Languages
     * @return array
     */
    public function getList():array
    {
        $result = [];
        $model = Language::find()->all();
        if($model)
        {
            foreach($model as $lang)
            {
               $result[$lang['iso_code']] = $lang['name'];
            }
        }
        return $result;
    }

    /*
     * Get list of statuses
     * @return array
     */
    public function getStatuses():array
    {
        return [
            self::STATUS_ACTIVE => Yii::t('menu', 'Active'),
            self::STATUS_DISABLE => Yii::t('menu', 'Disable'),
        ];
    }

    /*
     * Get list of main variables
     * @return array
     */
    public function getMain():array
    {
        return [
            self::STATUS_ACTIVE => Yii::t('language', 'main'),
            self::STATUS_DISABLE => Yii::t('language', 'not main'),
        ];
    }

}
