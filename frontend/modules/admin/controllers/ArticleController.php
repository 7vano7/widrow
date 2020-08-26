<?php

namespace frontend\modules\admin\controllers;

use frontend\modules\admin\models\Article;
use frontend\modules\admin\models\ArticleSearch;
use frontend\modules\admin\models\ArticleTranslation;
use frontend\modules\admin\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER)) {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single Article model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER)) {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER)) {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = new Article(['scenario' => 'insert']);
        $model->lang[] = new ArticleTranslation();
        if (Yii::$app->request->post('Article')) {
            $model->attributes = Yii::$app->request->post('Article');
            $model->user_id = Yii::$app->user->id;
            if ($_FILES['Article']['size']['image'] != false) {
                $model->saveImage('image');
            }
            if ($_FILES['Article']['size']['gif'] != false) {
                $model->saveImage('gif');
            }
            $validateProduct = false;
            if (Yii::$app->request->post('ArticleTranslation')) {
                $model->lang = [];
                $validateProduct = true;
                foreach (Yii::$app->request->post('ArticleTranslation') as $articleLang) {
                    $model_lang = new ArticleTranslation();
                    $model_lang->attributes = $articleLang;
                    $model_lang->article_id = 1;
                    $validateProduct = $model_lang->validate() && $validateProduct;
                    $model->lang[] = $model_lang;
                }
            }

            if ($validateProduct && $model->save()) {
                Yii::$app->session->setFlash('saved', Yii::t('admin', 'record saved'));
                return $this->redirect('index');
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER)) {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = $this->findModel($id);
        $model->lang = $model->articleTranslation;
        if (!$model->lang)
            $model->lang = new ArticleTranslation();

        if (Yii::$app->request->post('Article')) {
            $model->attributes = Yii::$app->request->post('Article');
            if ($_FILES['Article']['size']['image'] != false) {
                $model->saveImage('image');
            }
            if ($_FILES['Article']['size']['gif'] != false) {
                $model->saveImage('gif');
            }
            if (!$model->image)
                $model->image = $model->oldAttributes['image'];
            if (!$model->gif)
                $model->gif = $model->oldAttributes['gif'];
            $validateProduct = false;
            if (Yii::$app->request->post('ArticleTranslation')) {
                $model->lang = [];
                $validateProduct = true;
                foreach (Yii::$app->request->post('ArticleTranslation') as $articleLang) {
                    $model_lang = new ArticleTranslation();
                    $model_lang->attributes = $articleLang;
                    $model_lang->article_id = 1;
                    $validateProduct = $model_lang->validate() && $validateProduct;
                    $model->lang[] = $model_lang;
                }
            }
            if ($validateProduct && $model->save()) {
                Yii::$app->session->setFlash('saved', Yii::t('admin', 'record saved'));
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Article model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER)) {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = $this->findModel($id);
        $image = $model->image;
        $gif = $model->gif;
        $model->delete();
        ArticleTranslation::deleteAll(['article_id' => $id]);
        $path = Yii::getAlias('@frontend') . '/web';
        if (file_exists($path . $image)) {
            unlink(realpath($path . $image));
            $image = preg_replace('/resize_/', '', $image);
            unlink(realpath($path . $image));
        }
        if ($gif) {
            if (file_exists($path . $gif)) {
                unlink(realpath($path . $gif));
                $gif = preg_replace('/resize_/', '', $gif);
                unlink(realpath($path . $gif));
            }
        }
        Yii::$app->session->setFlash('delete', Yii::t('admin', 'record deleted'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the StaticPage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Return ArticleTranslation model fields in _form file
     *$param post string
     *$return json
     */
    public function actionLanguage()
    {
        if (Yii::$app->request->post('lang') && Yii::$app->request->post('index')) {
            $model = new Article();
            $model->lang = new ArticleTranslation();
            $json['data'] = $this->renderPartial('_form_lang', [
                'model' => $model->lang,
                'index' => Yii::$app->request->post('index')
            ]);
            echo json_encode($json);
        }
    }

    public function actionTop($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER)) {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = $this->findModel($id);
        if ($model->top == $model::IS_TOP)
            $model->top = $model::NOT_TOP;
        else
            $model->top = $model::IS_TOP;
        if ($model->save())
            return $this->redirect('index');
    }

    public function actionStatus($id)
    {
        if (Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER)) {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = $this->findModel($id);
        if ($model->status == $model::STATUS_ACTIVE)
            $model->status = $model::STATUS_DISABLE;
        else
            $model->status = $model::STATUS_ACTIVE;
        if ($model->save())
            return $this->redirect('index');
    }
}
