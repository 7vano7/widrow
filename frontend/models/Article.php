<?php

namespace frontend\models;

use Yii;

/**
 * Class Article
 * @package frontend\models
 */
Class Article extends \common\models\Article
{

    /**
     * Get articles by category
     * @param $category
     * @return array
     */
    public function getArticlesByCategory($category, $count = null):array
    {
        $list = [];
        $count = $count ? $count : 16;
        $top = ArticleTranslation::find()->joinWith(['article'])->where(['article.status'=>Article::STATUS_ACTIVE,
            'article.category'=>$category, 'article.top'=>Article::IS_TOP, 'article_translation.lang'=>Yii::$app->language])->orderBy
        (['article.id'=>SORT_DESC])->limit($count)
            ->all();
        if(!empty($top)){
            $count = $count - count($top);
        }
        if($count) {
            $article = ArticleTranslation::find()->joinWith(['article'])->where(['article.status'=>Article::STATUS_ACTIVE,
                'article.category'=>$category, 'article.top'=>Article::NOT_TOP, 'article_translation.lang'=>Yii::$app->language])->orderBy(['article.id'=>SORT_DESC])->limit
            ($count)->all();
        }
        if($article) {
            $articles = array_merge($top, $article);
        } elseif($top) {
            $articles = $top;
        }
        else {
            $articles = ArticleTranslation::find()->joinWith(['article'])->where(['article.status'=>Article::STATUS_ACTIVE,
                'article.category'=>$category, 'article_translation.lang'=>Yii::$app->language])->orderBy(['article.id'=>SORT_DESC])->limit
            ($count)->all();
        }
        if($articles) {
            foreach($articles as $article) {
                $list[] = [
                  'url'=> $article->article->url,
                  'image'=> $article->article->gif ? $article->article->gif : $article->article->image,
                  'title'=> $article->title,
                ];
            }
        }
        return $list;
    }

    /**
     * Get Category name
     * @param $id integer
     * @return \yii\db\ActiveQuery
     */
    public function getCategoryName($id)
    {
        return $category = MenuLang::find()->where(['menu_id'=>$id, 'lang'=>Yii::$app->language])->one();
//        return $this->has(MenuLang::className(), ['menu_id'=>'category']);
//        if($menu && $menu->primaryModel) {
//            echo "<pre>";print_r($menu);die;
//            return MenuLang::find()->where(['menu_id'=>$menu->primaryModel->id, 'lang'=>Yii::$app->language])->one();
//        }
    }
}