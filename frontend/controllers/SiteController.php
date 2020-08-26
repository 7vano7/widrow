<?php
namespace frontend\controllers;

use frontend\models\StaticPage;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\Url;
use yii\web\BadRequestHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\User;
use frontend\modules\admin\models\googleAuth\GoogleAuthenticator;
use yii\web\NotFoundHttpException;
use frontend\components\AuthHandler;
use frontend\models\Article;
use frontend\models\Menu;
use frontend\models\StaticPageTranslation;
use frontend\models\MenuLang;

/**
 * Site controller
 */
class SiteController extends HeadController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => [
                'class' => 'yii\authclient\AuthAction',
                'successCallback' => [$this, 'onAuthSuccess'],
            ],
        ];
    }


    /*
     * Sign in or signup using OAuth
     */
    public function onAuthSuccess($client)
    {
        (new AuthHandler($client))->handle();
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
//        $this->setMetaData(Yii::t('site', 'FSLU'), Yii::t('head', 'MainDesc'), Yii::t('head', 'MainCont'));
        $this->getUserLanguage();
//        echo "<pre>";print_r($lang);die;
        $main = StaticPageTranslation::find()->joinWith(['staticPage'])->where([
            'static_page.position'=>StaticPage::POSITION_MAIN,
            'static_page_translation.lang'=>Yii::$app->language])->orderBy(['static_page.id'=>SORT_ASC])->one();
        $categories = MenuLang::find()->joinWith(['menu'])->where(['menu.status'=>Menu::STATUS_ACTIVE, 'menu.is_menu'=>Menu::MENU_TRUE, 'menu_lang.lang'=>Yii::$app->language])->orderBy(['menu.id'=>SORT_ASC])->all();
        $list = [];
        $video = [];
        $youtube = MenuLang::find()->joinWith(['menu'])->where(['menu.status'=>Menu::STATUS_ACTIVE, 'menu.is_menu'=>Menu::MENU_FALSE, 'menu_lang.lang'=>Yii::$app->language])->orderBy(['menu.id'=>SORT_ASC])->all();
        if($categories) {
            $articles = new Article();
            foreach ($categories as $category) {
                $list[$category->menu->position]=[
                    'id'=>$category->menu->id,
                    'image'=>$category->menu->image,
                    'label'=>$category->menu_name,
                    'url'=>$category->menu->url,
                    'articles'=>$articles->getArticlesByCategory($category->menu_id),
                ];
            }
        }
        if($youtube) {
            $articles = new Article();
            foreach ($youtube as $category) {
                $video[$category->menu->position]=[
                    'id'=>$category->menu->id,
                    'image'=>$category->menu->image,
                    'label'=>$category->menu_name,

                    'url'=>'https://youtube.com',
//                    'url'=>$category->menu->url,
                    'articles'=>$articles->getArticlesByCategory($category->menu_id, 18),
                ];
            }
        }
        return $this->render('index', ['model'=>$list, 'main'=>$main, 'video'=>$video]);

    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->getUserLanguage();
        setcookie('login_now', 'login_now', time()+300);
        $this->setMetaData(Yii::t('head', 'Login'), Yii::t('head', 'LoginDesc'),Yii::t('head', 'LoginCont'));
        $model = new LoginForm();
        // if ($model->load(Yii::$app->request->post()) && $model->login()) {
        //     return $this->goBack();
        // } else {
        //     $model->password = '';
        //     return $this->render('login', [
        //         'model' => $model,
        //     ]);
        // }
        if(Yii::$app->request->post() && isset($_POST['LoginForm']['password']) )
        {
            if ($model->load(Yii::$app->request->post()) && $model->validate())
            {
                if(Yii::$app->cache->exists('authenticate'))
                {
                    Yii::$app->cache->set('user', $model, 300);
                    return $this->render('login', [
                        'model' => $model,
                    ]);
                }elseif($model->login())
                {
                    setcookie('login_now', '', time()-3600);
                    return $this->redirect(Url::toRoute('/admin'));
                }
            }
        }
        if(Yii::$app->request->post() && isset($_POST['LoginForm']['google_auth']))
        {
            $ga = new GoogleAuthenticator;
            $secret = Yii::$app->cache->get('authenticate');
            $code = $ga->getCode($secret);
            if ($code != Yii::$app->request->post('LoginForm')['google_auth'])
            {
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
            // if(isset($_COOKIE['authenticate']))
            // {
            //     setcookie("authenticate", "", time() - 3600);
            // }
            $model = Yii::$app->cache->get('user');
            if($model->login())
            {
                setcookie('login_now', '', time()-3600);
                Yii::$app->cache->delete('authenticate');
                Yii::$app->cache->delete('user');
                return $this->goBack();
            }
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {   if(Yii::$app->cache->exists('authenticate'))
        Yii::$app->cache->delete('authenticate');
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContacts()
    {
        $this->setMetaData(Yii::t('head', 'Contacts'), Yii::t('head', 'ContactsDesk'), Yii::t('head', 'ContactsCont'));
        return $this->render('contacts');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $this->getUserLanguage();
        setcookie('sign_now', 'sign_now', time()+300);
        $this->setMetaData(Yii::t('head', 'Sign'), Yii::t('head', 'SignDesc'), Yii::t('head', 'SignCont'));
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $model->setPassword($model->password_hash);
            if ($model->save()) {
                $model->password_hash = Yii::$app->request->post('SignupForm')['password_hash'];
                if($_COOKIE['sign_now'])
                    setcookie('sign_now', '', time()-3600);
                Yii::$app->mailer->compose('signup', ['session' => $model])->setFrom([Yii::$app->params['Email'] => Yii::t('site', 'FSLU')])->setTo($model->email)->setSubject(Yii::t('site', 'regSuccess'))->send();
                Yii::$app->session->setFlash('success', Yii::t('site', 'signSuccess'));
                return $this->goHome();
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', Yii::t('site', 'resetPassword'));
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', Yii::t('site', 'resetPasswordError'));
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', Yii::t('site', 'passSaved'));

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /*
     * Activate user after registration
     * @return mixed
     */
    public function actionActive() {
        if (!Yii::$app->request->get('hash') && !Yii::$app->request->get('hash') != "") {
            throw new NotFoundHttpException(Yii::t('site', 'not user'));
        }
        $id = Yii::$app->request->get('hash');
        $query = User::find()->where(['auth_key' => $id])->one();
        if (!$query) {
            throw new NotFoundHttpException(Yii::t('site', 'not user data'));
        }
        if ($query->status == User::STATUS_BLOCKED) {
            $query->status = User::STATUS_ACTIVE;
        }
        if ($query->active == User::STATUS_BLOCKED) {
            $query->active = User::STATUS_ACTIVE;
        }
        if ($query->save()) {
            Yii::$app->getSession()->setFlash('success', Yii::t('site', 'user activated'));
            return $this->goHome();
        } elseif($query->firstErrors) {
            $errors = $query->firstErrors;
            throw new UserException(reset($errors));
        }
    }

    /**
     * Display static page
     * @param $alias string
     */
    public function actionStatic($alias) {
        if (!$alias) {
            throw new NotFoundHttpException(Yii::t('site', 'The requested page does not exist.'));
        }
        $model = StaticPageTranslation::find()->joinWith(['staticPage'])->where(['static_page.url'=>$alias, 'static_page.status'=>StaticPage::STATUS_ACTIVE, 'static_page_translation.lang'=>Yii::$app->language])->one();
        if(!$model) {
            throw new NotFoundHttpException(Yii::t('site', 'The requested page does not exist.'));
        }
        return $this->render('static', ['model'=>$model]);
    }


}
