<?php
namespace frontend\components;

use yii\base\Widget;
use frontend\models\Language;
use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

/**
 * Class LanguageViewWidget
 * @package frontend\components
 */
class LanguageViewWidget extends Widget
{
    public function run()
    {
        $list = Language::find()->asArray()->where(['status'=>Language::STATUS_ACTIVE])->all();
        return $this->render('language/language', ['languages'=>$list]);
    }
}
