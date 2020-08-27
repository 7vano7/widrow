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
class ArticleController extends HeadController
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
     * Displays Artilce model.
     *
     * @return mixed
     */
    public function actionView($alias)
    {
//        $this->getUserLanguage();
//        $this->setMetaData(Yii::t('site', 'FSLU'), Yii::t('head', 'MainDesc'), Yii::t('head', 'MainCont'));
        if (!$alias) {
            throw new NotFoundHttpException(Yii::t('site', 'The requested page does not exist.'));
        }
        $model = ArticleTranslation::find()->joinWith(['article'])->where(['article.url' => $alias, 'article.status' => Article::STATUS_ACTIVE, 'article_translation.lang' => Yii::$app->language])->one();
        if (!$model) {
            throw new NotFoundHttpException(Yii::t('site', 'The requested page does not exist.'));
        }
        $url = Menu::findOne($model->article->category)->url;
        $list = ArticleTranslation::find()->joinWith(['article'])->where(['article.category' => $model->article->category,
            'article.status' => Article::STATUS_ACTIVE, 'article_translation.lang' => Yii::$app->language])->andWhere(['!=', 'article.id', $model->article_id])->orderBy(['article.id' => SORT_DESC])
            ->all();
        return $this->render('view', ['model' => $model, 'list' => $list, 'url'=>$url]);

    }

    /**
     * Search articles
     * @param $id string
     * @return $mixed
     */
    public function actionSearch($id)
    {
        if(!$id) {
            throw new NotFoundHttpException(Yii::t('site', 'The requested page does not exist.'));
        }
        $list = ArticleTranslation::find()->joinWith(['article'])->where(['like', 'article_translation.title', $id])
            ->andWhere(['article.status'=>Article::STATUS_ACTIVE, 'article_translation.lang'=>Yii::$app->language])
            ->all();
        return $this->render('search', ['list'=>$list]);
    }
}
