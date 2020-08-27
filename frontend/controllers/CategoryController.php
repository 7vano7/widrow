<?php
namespace frontend\controllers;

use frontend\models\ArticleTranslation;
use frontend\models\StaticPage;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\models\User;
use yii\web\NotFoundHttpException;
use frontend\models\Article;
use frontend\models\Menu;
use frontend\models\StaticPageTranslation;
use frontend\models\MenuLang;

/**
 * Category Controller
 */
class CategoryController extends HeadController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
     * Displays artilce list by category.
     *
     * @return mixed
     */
    public function actionIndex($alias)
    {
//        $this->getUserLanguage();
//        $this->setMetaData(Yii::t('site', 'FSLU'), Yii::t('head', 'MainDesc'), Yii::t('head', 'MainCont'));
        if(!$alias) {
            throw new NotFoundHttpException(Yii::t('site', 'The requested page does not exist.'));
        }
        $id = Menu::find()->where(['url'=>$alias])->one();
        if(!$id) {
            throw new NotFoundHttpException(Yii::t('site', 'The requested page does not exist.'));
        }
        $articles = ArticleTranslation::find()->joinWith(['article'])->where(['article.category'=>$id->id, 'article_translation.lang'=>Yii::$app->language, 'article.status'=>Article::STATUS_ACTIVE, 'article.top'=>Article::IS_TOP])->orderBy(['article.id'=>SORT_DESC])->limit(50)->all();
        if(!empty($articles) && count ($articles) < 50) {
            $count = 50-count($articles);
            $list = ArticleTranslation::find()->joinWith(['article'])->where(['article.category'=>$id->id, 'article_translation.lang'=>Yii::$app->language, 'article.status'=>Article::STATUS_ACTIVE, 'article.top'=>Article::NOT_TOP])->orderBy(['article.id'=>SORT_DESC])->limit($count)->all();
            if(!empty($list)) {
                $articles = array_merge($articles, $list);
            }
        } else {
            $articles = ArticleTranslation::find()->joinWith(['article'])->where(['article.category'=>$id->id, 'article_translation.lang'=>Yii::$app->language, 'article.status'=>Article::STATUS_ACTIVE])->orderBy(['article.id'=>SORT_DESC])->limit(50)->all();

        }
        $category = Menu::find()->where(['status'=>Menu::STATUS_ACTIVE, 'is_menu'=>Menu::MENU_TRUE])->all();
        $list = [];
        if(!empty($category)) {
            foreach ($category as $item) {
                $article = ArticleTranslation::find()->joinWith(['article'])
                    ->where(['article_translation.lang'=>Yii::$app->language, 'article.status'=>Article::STATUS_ACTIVE])
                    ->andWhere(['article.category'=> $item->id])
                    ->orderBy(['article.id'=>SORT_DESC])
                    ->limit(3)->all();
                $key = $item->id;
                if($item->id == $id->id) {
                    $key = 1000;
                }
                $list[$key] = [
                    'items' => $article,
                    'id' => $item->id,
                    'url' => $item->url,
                ];
            }
        }
        ksort($list);
        return $this->render('index', ['models'=>$articles, 'list'=>$list]);
    }

    /**
     * Get articles list by category to json
     * $return json
     */
    public function actionAddarticles()
    {
        if(Yii::$app->request->isPost) {
            $category = Yii::$app->request->post('category');
            $id = Yii::$app->request->post('index');
            $articles = ArticleTranslation::find()->joinWith(['article'])->where(['article.category'=>$category, 'article_translation.lang'=>Yii::$app->language, 'article.status'=>Article::STATUS_ACTIVE])->orderBy(['article.id'=>SORT_DESC])->offset($id)->limit(50)->all();
            if(!empty($articles)) {
                $content = $this->renderPartial('add_category_articles', ['models'=>$articles]);
            } else {
                $content = $this->renderPartial('no_articles');
            }
            $data['content'] = $content;
            return json_encode($data);
        }
    }

    /**
     * Get articles list to json
     * $return json
     */
    public function actionListarticles()
    {
        if(Yii::$app->request->isPost) {
            $id = Yii::$app->request->post('index');
            $articles = ArticleTranslation::find()->joinWith(['article'])->where(['article_translation.lang'=>Yii::$app->language, 'article.status'=>Article::STATUS_ACTIVE])->orderBy(['article.id'=>SORT_DESC])->offset($id)->limit(50)->all();
            if(!empty($articles)) {
                $content = $this->renderPartial('add_list_articles', ['models'=>$articles]);
            } else {
                $content = $this->renderPartial('no_articles');
            }
            $data['content'] = $content;
            return json_encode($data);
        }
    }
}
