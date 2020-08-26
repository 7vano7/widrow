<?php

namespace frontend\modules\admin;

use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'frontend\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->registerTranslations();

        // custom initialization code goes here
    }

    public function registerTranslations()
    {
        Yii::$app->i18n->translations['*'] = [
            'class'          => 'yii\i18n\PhpMessageSource',
//            'sourceLanguage' => 'fr',
            'basePath'       => '@frontend/modules/admin/messages',
            'fileMap'        => [


            ],
        ];
    }

//    public static function t($category, $message, $params = [], $language = null)
//    {
//        return Yii::t('@frontend/modules/admin/' . $category, $message, $params, $language);
//    }
}
