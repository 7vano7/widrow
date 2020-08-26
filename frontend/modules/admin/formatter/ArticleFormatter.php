<?php

namespace frontend\modules\admin\formatter;


use frontend\modules\admin\models\Article;
use frontend\modules\admin\models\User;
use yii\helpers\Html;
use frontend\components\FrontendFormatter;
use Yii;

/**
 * Class ArticleFormatter
 * @package frontend\modules\admin\formatter
 */
class ArticleFormatter extends FrontendFormatter
{
    /**
     * Formatter image
     * @param $data object
     * @return string
     */
    public function asPhoto($data): string
    {

        return '<img src="' . $data->image . '" style="width:100px;">';
    }

    /**
     * Formatter gif
     * @param $data object
     * @return string
     */
    public function asGif($data): string
    {
        if($data->gif)
            return '<img src="' . $data->gif . '" style="width:100px;">';
        return Yii::t('admin', 'not set');
    }

    /**
     * Formatter title
     * @param $data object
     * @return string
     */
    public function asTitle($data): string
    {

        $res = Yii::t('admin', 'not set');
        $title = '';
        if ($data->articleTranslation) {
            foreach ($data->articleTranslation as $article) {
                if ($article->lang == Yii::$app->language) {
                    $title = $article->title;
                }
            }
            if ($title) {
                $res = $title;
            } else {
                $res = 'Not set on this->language';
            }
        }
        return $res;
    }

    /**
     * Formatter language for view
     * @param $value string
     * @return string
     */
    public function asTitleLang($value)
    {
        $res = Yii::t('admin', 'not set');
        if ($value)
            $res = $value;
        return $res;
    }

    /**
     * Formatter laanguage
     * @param $data object
     * @return string
     */
    public function asLang($data): string
    {
        $res = Yii::t('admin', 'not set');
        if ($data) {
            $res = '<span class="flag-icon flag-icon-"' . $data->lang . '></span><span> ' . $data->lang . '</span>';
            if ($data->lang == 'uk') {
                $res = '<span class="flag-icon flag-icon-ua"></span><span> ' . $data->lang . '</span>';
            }
            if ($data->lang == 'us') {
                $res = '<span class="flag-icon flag-icon-us"></span><span> ' . $data->lang . '</span>';
            }
        }
        return $res;
    }

    /**
     * Formatter category
     * @param $data object
     * @return string
     */
    public function asCategory($data): string
    {
        $res = Yii::t('admin', 'not set');
        if ($data) {
            $category = $data->getCategory(Yii::$app->language, $data->category);
            if ($category) {
                $res = $category;
            }
        }
        return $res;
    }

    /**
     * Formatter top
     * @param $data integer
     * @return string
     */
    public function asTop($value): string
    {
        $top = [
            Article::IS_TOP => 'success',
            Article::NOT_TOP => 'danger',
        ];
        $res = Yii::t('admin', 'not set');
        if (array_key_exists($value, $top)) {
            $res = Html::tag('span', Yii::t('article', (new Article())->getTop()[$value]), ['class' => 'label label-'
                . $top[$value]]);
        }
        return $res;
    }

    /**
     * Formatter status
     * @param $data string
     * @return string
     */
    public function asStatus($value): string
    {
        $status = [
            Article::STATUS_ACTIVE => 'success',
            Article::STATUS_DISABLE => 'danger',
        ];

        $res = Yii::t('admin', 'not set');
        if ($value && array_key_exists($value, $status)) {
            $res = Html::tag('span', Yii::t('article', $value), ['class' => 'label label-'
                . $status[$value]]);
        }
        return $res;
    }

    /**
     * Formatter user
     * @param $value integer
     * @return string
     */
    public function asUser($value): string
    {
        $res = Yii::t('admin', 'not set');
        if($value) {
            $user = User::findOne($value)->email;
            $res = Html::a($user, Yii::$app->urlManager->createUrl(['/admin/user/view', 'id'=>$value]));
        }

        return $res;
    }
}