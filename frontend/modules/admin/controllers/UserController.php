<?php

namespace frontend\modules\admin\controllers;

use frontend\modules\admin\models\User;
use frontend\modules\admin\models\UserSearch;
use frontend\modules\admin\models\googleAuth\GoogleAuthenticator;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use Yii;

Class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'delete' => ['POST'],
//                ],
//            ],
//        ];
//    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_ADMIN))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new User;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model'=>$model,
        ]);
    }

    /**
     * Displays a single User model.
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
        if (!Yii::$app->user->can(User::ROLE_ADMIN))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = $this->findModel($id);
        return $this->render('view', ['model'=>$model]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_ADMIN))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = new User(['scenario'=>'insert']);

        if(Yii::$app->request->post('User'))
        {
            $model->attributes = Yii::$app->request->post('User');
            $model->active = $model::STATUS_ACTIVE;
            $model->setPassword($model->password_hash);
            if($model->validate() && $model->save())
            {
                Yii::$app->session->setFlash('saved', Yii::t('admin', 'record saved'));
                return $this->redirect('index');
            }
        }
        return $this->render('create', ['model'=>$model]);
    }

    /**
     * Updates a single User model.
     * If update is successful, the browser will be redirected to the 'index' page.
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
        if (!Yii::$app->user->can(User::ROLE_ADMIN))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = $this->findModel($id);
        if(Yii::$app->request->post('User'))
        {
            $password = $model->password_hash;
            $model->load(Yii::$app->request->post());
            if($password !== $model->password_hash)
            {
                $model->setPassword($model->password_hash);
            }
            if($model->validate() && $model->save())
            {
                Yii::$app->session->setFlash('saved', Yii::t('admin', 'record saved'));
                return $this->redirect('index');
            }
        }
        return $this->render('create', ['model'=>$model]);
    }

    /**
     * Deletes an existing User model.
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
        if (!Yii::$app->user->can(User::ROLE_ADMIN))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = User::findOne($id)->delete();
        Yii::$app->session->setFlash('delete', Yii::t('admin', 'record deleted'));
        return $this->redirect('index');
    }

    /**
     * DActive/Blocked an existing Sportsmen model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionActive($id)
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        if (!Yii::$app->user->can(User::ROLE_ADMIN))
        {
            throw new ForbiddenHttpException(Yii::t('admin', 'access deny'));
        }
        $model = $this->findModel($id);
        if($model->status == $model::STATUS_ACTIVE)
            $model->status = $model::STATUS_BLOCKED;
        else
            $model->status = $model::STATUS_ACTIVE;
        if($model->save())
            return $this->redirect('index');
    }

    public function findModel($id)
    {
        $model = User::findOne($id);
        if(!$model)
        {
            throw new NotFoundHttpException(Yii::t('admin', 'Not found'));
        }
        return $model;
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProfile()
    {
        if(Yii::$app->user->isGuest)
        {
            Yii::$app->session->setFlash('danger', 'Not authorized');
            return $this->redirect('/site/login');
        }
        $id = Yii::$app->user->id;
        if(!$id)
        {
           throw new NotFoundHttpException(Yii::t('admin', 'not found'));
        }
        $model = $this->findModel($id);
        $ga = new GoogleAuthenticator;
        $auth['auth'] = $ga->generateSecret();

//        $auth['qr_code'] = $ga->getUrl($model->username,'archery',$auth['auth']);
//        $url =  sprintf("otpauth://totp/%s?secret=%s", $alias, $secret);
//        $encoder = 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=';
//        $qrImageURL = sprintf( "%s%s",$encoder, urlencode($url));
        $url =  sprintf("otpauth://totp/%s?secret=%s", 'media.zmogesh.com',$auth['auth']);
        $encoder = 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl=';
        $auth['qr_code'] = sprintf( "%s%s",$encoder, urlencode($url));

        if(Yii::$app->request->post())
        {
            if(Yii::$app->request->post('User'))
            {
                $password = $model->password_hash;
                $model->load(Yii::$app->request->post());
                if($password !== $model->password_hash)
                {
                    $model->setPassword($model->password_hash);
                }
                if($model->validate() && $model->save())
                {
                    Yii::$app->session->setFlash('saved', Yii::t('admin', 'record saved'));
                    return $this->redirect('index');
                }
            }
//            $ga=new GoogleAuthenticator;
//            $code=$ga->getCode($user->ga_secret);
//            if ($code!=$_POST['code']) return new AuthError('invalid code');
        }

        return $this->render('profile', ['model'=>$model, 'auth'=>$auth]);
    }
}