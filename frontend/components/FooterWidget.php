<?php
namespace frontend\components;

use yii\base\Widget;
use frontend\models\StaticPage;
use frontend\models\StaticPageTranslation;
use Yii;

/**
 * Class FooterWidget
 * @package frontend\components
 */
class FooterWidget extends Widget
{
    public function run()
    {
        $pages = StaticPageTranslation::find()->joinWith(['staticPage'])->asArray()->where(['static_page.status'=>StaticPage::STATUS_ACTIVE,
            'static_page.position'=>StaticPage::POSITION_FOOTER,
            'static_page_translation.lang'=>Yii::$app->language])->orderBy(['static_page.id'=>SORT_ASC])->all();
        return $this->render('footer/index', ['pages'=>$pages]);
    }
}
