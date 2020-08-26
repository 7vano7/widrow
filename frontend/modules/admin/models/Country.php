<?php

namespace frontend\modules\admin\models;

use Yii;

class Country extends \common\models\Country
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'iso_code'], 'required'],
            [['name'], 'string', 'max' => 191],
            [['iso_code', 'phone_code'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin','ID'),
            'created_at' => Yii::t('admin','Created'),
            'updated_at' => Yii::t('admin','Updated'),
            'name' => Yii::t('country','Name'),
            'iso_code' => Yii::t('country','Iso code'),
            'phone_code' => Yii::t('country','Phone Code'),
        ];
    }

    /*
     * Get list of Country models
     * @return array
     */
    public function getList()
    {
        $result = [];
        $model = self::find()->all();
        if($model)
        {
            foreach($model as $lang)
            {
                $result[$lang['name']] = $lang['name'];
            }
        }
        return $result;
    }
}