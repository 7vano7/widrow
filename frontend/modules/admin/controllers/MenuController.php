<?php

namespace frontend\modules\admin\controllers;

use frontend\modules\admin\models\MenuLang;
use frontend\modules\admin\models\Submenu;
use frontend\modules\admin\models\User;
use Yii;
use frontend\modules\admin\models\Menu;
use frontend\modules\admin\models\MenuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;

/**
 * MenuController implements the CRUD actions for Menu model.
 */
class MenuController extends Controller
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
     * Lists all Menu models.
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
        $searchModel = new MenuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Menu model.
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
     * Creates a new Menu model.
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
        $model = new Menu();
        $model->lang[] = new MenuLang();
        if(Yii::$app->request->post('Menu'))
        {
            $model->attributes = Yii::$app->request->post('Menu');
            if ($_FILES['Menu']['size']['image'] != false) {
                $model->saveImage('image');
            }
            $validateProduct = true;
            if (Yii::$app->request->post('MenuLang')) {
                $model->lang = [];
                foreach (Yii::$app->request->post('MenuLang') as $menuLang)
                {
                    $model_lang = new MenuLang();
                    $model_lang->attributes = $menuLang;
                    $model_lang->menu_id = 1;
                    $model_lang->submenu_id = $model->parent_name;
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
     * Updates an existing Menu model.
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
        $model->lang = $model->menuLang;
        if(!$model->lang)
        $model->lang = new MenuLang();

        if(Yii::$app->request->post('Menu'))
        {
            $model->attributes = Yii::$app->request->post('Menu');
            if ($_FILES['Menu']['size']['image'] != false) {
                $model->saveImage('image');
            }

            if (!$model->image)
                $model->image = $model->oldAttributes['image'];
            $validateProduct = true;
            if (Yii::$app->request->post('MenuLang')) {
                $model->lang = [];
                foreach (Yii::$app->request->post('MenuLang') as $menuLang)
                {
                    $model_lang = new MenuLang();
                    $model_lang->attributes = $menuLang;
                    $model_lang->menu_id = 1;
                    $model_lang->submenu_id = $model->menuLang[0]->submenu_id;
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
     * Deletes an existing Menu model.
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
        $model = $this->findModel($id);
        $image = $model->image;
        $model->delete();
        MenuLang::deleteAll(['menu_id'=>$id]);
        $path = Yii::getAlias('@frontend') . '/web';
        if (file_exists($path . $image)) {
            unlink(realpath($path . $image));
            $image = preg_replace('/resize_/', '', $image);
            unlink(realpath($path . $image));
        }
        Yii::$app->session->setFlash('delete', Yii::t('admin', 'record deleted'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Menu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Menu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Menu::find()->where(['id'=>$id, 'is_menu'=>Menu::MENU_TRUE])->one()   ) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Return MenuLang model fields in _form file
     *$param post string
     *$return json
     */
    public function actionLanguage()
    {
        if(Yii::$app->request->post('lang') && Yii::$app->request->post('index'))
        {
            $model = new Menu();
            $model->lang = new MenuLang();
            $json['data'] = $this->renderPartial('_form_lang', [
                'model' => $model->lang,
                'index'=>Yii::$app->request->post('index')
            ]);
            echo json_encode($json);
        }
    }
}
