<?php

namespace frontend\models;

use Yii;

/**
 * Class ArticleTranslation
 * @package frontend\models
 */
Class ArticleTranslation extends \common\models\ArticleTranslation
{
    /*
         * Get relation Article model
         * @params mixed
         * @return object
         */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id'=>'article_id']);
    }
}