<?php

namespace frontend\modules\admin\controllers;

use Yii;
use frontend\modules\admin\models\Language;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use frontend\modules\admin\models\Country;
use frontend\modules\admin\models\User;

/**
 * LanguageController implements the CRUD actions for Language model.
 */
class LanguageController extends Controller
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
     * Lists all Language models.
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
        $dataProvider = new ActiveDataProvider([
            'query' => Language::find()->orderBy(['id' => SORT_DESC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Language model.
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
     * Creates a new Language model.
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
        $model = new Language();

        if ($model->load(Yii::$app->request->post())) {
            $country = Country::find()->where(['name' => $model->name])->one();
            $model->iso_code = $country->iso_code;
            if ($model->validate() && $model->save()) {
                Yii::$app->session->setFlash('saved', Yii::t('admin', 'record saved'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Language model.
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
        if ($model->load(Yii::$app->request->post())) {
            $country = Country::find()->where(['name' => $model->name])->one();
            $model->iso_code = $country->iso_code;
            if ($model->validate()) {
                if ($model->main == Language::STATUS_ACTIVE) {
                    Language::updateAll(['main' => Language::STATUS_DISABLE]);
                }
                $model->save();
                Yii::$app->session->setFlash('saved', Yii::t('admin', 'record saved'));
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Language model.
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
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('delete', Yii::t('admin', 'record deleted'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Language model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Language the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Language::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
