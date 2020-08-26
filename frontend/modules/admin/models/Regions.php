<?php

namespace frontend\modules\admin\models;

use Yii;

class Regions extends \common\models\Regions
{
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name_uk' => Yii::t('region', 'Name UK'),
            'name_us' => Yii::t('region', 'Name US'),
            'created_at' => Yii::t('admin', 'Created'),
            'updated_at' => Yii::t('admin', 'Updated'),
        ];
    }

    /*
     * Get list of regions
     * @return array
     */
    public function getList():array
    {
        $array = [];
        if(Yii::$app->language != 'uk')
            $lang = 'us';
        else
            $lang = Yii::$app->language;
        $models = Regions::find()->asArray()->all();
        if($models)
        {
            foreach ($models as $model)
            {
                $array[$model['id']] = $model['name_'.$lang];
            }
        }
        return $array;
    }
}
