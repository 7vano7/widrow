<?php

namespace frontend\modules\admin\controllers;

use frontend\modules\admin\models\MainPage;
use frontend\modules\admin\models\StaticPage;
use frontend\modules\admin\models\StaticPageTranslation;
use frontend\modules\admin\models\User;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * StaticPageController implements the CRUD actions for StaticPage model.
 */
class StaticPageController extends Controller
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
     * Lists all StaticPage models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $dataProvider = new ActiveDataProvider([
            'query' => StaticPage::find()->where(['position'=>StaticPage::POSITION_FOOTER])->orderBy(['id'=>SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single StaticPage model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new StaticPage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = new StaticPage();
        $model->lang[] = new StaticPageTranslation();
        if(Yii::$app->request->post('StaticPage'))
        {
            $model->attributes = Yii::$app->request->post('StaticPage');
            $validateProduct = true;
            if (Yii::$app->request->post('StaticPageTranslation')) {
                $model->lang = [];
                foreach (Yii::$app->request->post('StaticPageTranslation') as $staticLang)
                {
                    $model_lang = new StaticPageTranslation();
                    $model_lang->attributes = $staticLang;
                    $model_lang->static_page_id = 1;
                    $validateProduct = $model_lang->validate() && $validateProduct;
                    $model->lang[] = $model_lang;
                }
            }

            if($model->save() && $validateProduct)
            {
                Yii::$app->session->setFlash('saved', Yii::t('admin', 'record saved'));
                return $this->redirect('index');
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing StaticPage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = $this->findModel($id);
        $model->lang = $model->pageTranslation;
        if(!$model->lang)
            $model->lang = new StaticPageTranslation();

        if(Yii::$app->request->post('StaticPage'))
        {
            $model->attributes = Yii::$app->request->post('StaticPage');
            $validateProduct = true;
            if (Yii::$app->request->post('StaticPageTranslation')) {
                $model->lang = [];
                foreach (Yii::$app->request->post('StaticPageTranslation') as $StaticLang)
                {
                    $model_lang = new StaticPageTranslation();
                    $model_lang->attributes = $StaticLang;
                    $model_lang->static_page_id = 1;
                    $validateProduct = $model_lang->validate() && $validateProduct;
                    $model->lang[] = $model_lang;
                }
            }
            if($model->save() && $validateProduct)
            {
                Yii::$app->session->setFlash('saved', Yii::t('admin', 'record saved'));
                return $this->redirect(['index']);
            }
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing StaticPage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $this->findModel($id)->delete();
        StaticPageTranslation::deleteAll(['static_page_id'=>$id]);
        Yii::$app->session->setFlash('delete', Yii::t('admin', 'record deleted'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the StaticPage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return StaticPage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = StaticPage::find()->where(['id'=>$id, 'position'=>StaticPage::POSITION_FOOTER])->one()) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Return StaticPageTranslation model fields in _form file
     *@param post string
     *@return json
     */
    public function actionLanguage()
    {
        if(Yii::$app->request->post('lang') && Yii::$app->request->post('index'))
        {
            $model = new StaticPage();
            $model->lang = new StaticPageTranslation();
            $json['data'] = $this->renderPartial('_form_lang', [
                'model' => $model->lang,
                'index'=>Yii::$app->request->post('index')
            ]);
            echo json_encode($json);
        }
    }

    /**
     * Return StaticPageTranslation model fields in _form file
     *@param post string
     *@return json
     */
    public function actionLanguagemain()
    {
        if(Yii::$app->request->post('lang') && Yii::$app->request->post('index'))
        {
            $model = new MainPage();
            $model->lang = new StaticPageTranslation();
            $json['data'] = $this->renderPartial('_form_lang_main', [
                'model' => $model->lang,
                'index'=>Yii::$app->request->post('index')
            ]);
            echo json_encode($json);
        }
    }

    /**
     * Edit main page
     */
    public function actionMain()
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_MANAGER))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = MainPage::find()->where(['position'=>StaticPage::POSITION_MAIN])->one();
        if(!$model) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $model->lang = StaticPageTranslation::find()->where(['static_page_id'=>$model->id])->all();
        if(!$model->lang)
            $model->lang = new StaticPageTranslation();

        if(Yii::$app->request->post('MainPage'))
        {
            $model->attributes = Yii::$app->request->post('MainPage');
            if ($_FILES['MainPage']['size']['file'] != false) {
                $model->saveImage('file');
            }
            if (!$model->file)
                $model->file = $model->oldAttributes['file'];
            $validateProduct = true;
            if (Yii::$app->request->post('StaticPageTranslation')) {
                $model->lang = [];
                foreach (Yii::$app->request->post('StaticPageTranslation') as $menuLang)
                {
                    $model_lang = new StaticPageTranslation();
                    $model_lang->attributes = $menuLang;
                    $model_lang->static_page_id = 1;
                    $model_lang->content = 'main page';
                    $validateProduct = $model_lang->validate() && $validateProduct;
                    $model->lang[] = $model_lang;
                }
            }
            if($validateProduct && $model->save())
            {
                Yii::$app->session->setFlash('saved', Yii::t('admin', 'record saved'));
                return $this->redirect(['main']);
            }
        }
        return $this->render('main', ['model'=>$model]);

    }
}
