<?php
namespace frontend\components;

// use app\models\Auth;
use frontend\models\User;
use Yii;
use yii\authclient\ClientInterface;
use yii\helpers\ArrayHelper;

/**
 * AuthHandler handles successful authentication via Yii auth component
 */
class AuthHandler
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function handle()
    {
        /*Sign in*/
        if (isset($_COOKIE['sign_now']) && $_COOKIE['sign_now'] == "sign_now")
        {
            $attributes = $this->client->getUserAttributes();
            $model = new User;
            if (ArrayHelper::getValue($attributes, 'email') && ArrayHelper::getValue($attributes, 'email') != "")
            {
                $email = ArrayHelper::getValue($attributes, 'email');
                $id = ArrayHelper::getValue($attributes, 'id');
                $nickname = ArrayHelper::getValue($attributes, 'name');
            }
            elseif (!ArrayHelper::getValue($attributes, 'name') || ArrayHelper::getValue($attributes, 'name') != "" || ArrayHelper::getValue($attributes, 'nickname') != "")
            {
                if(ArrayHelper::getValue($attributes, 'name') && ArrayHelper::getValue($attributes, 'name') !="")
                {
                    $nickname = ArrayHelper::getValue($attributes, 'name');
                    $email = "";
                    $id = ArrayHelper::getValue($attributes, 'id');
                }
                else
                {
                    $nickname = ArrayHelper::getValue($attributes, 'screen_name');
                    $email = "";
                    $id = ArrayHelper::getValue($attributes, 'id');
                }
            }
            $model->username = $nickname;
            $model->email = $email;
            $model->social_id = $id;
            $model->status = 5;
            $model->active = 5;
            $model->role = 'publisher';
            $pass= 'hyrdfsfnyhsrdgf';
            $model->setPassword($pass);
            if(!$model->save())
            {
                return Yii::$app->getResponse()->redirect('/site/signup');
            }
            $model->password_hash = $pass;
            setcookie('sign_now', '', time()-3600);

            Yii::$app->mailer->compose('signup', ['session' => $model])->setFrom([Yii::$app->params['Email'] => Yii::t('site', 'FSLU')])->setTo($model->email)->setSubject(Yii::t('site', 'regSuccess'))->send();
            Yii::$app->session->setFlash('success', Yii::t('site', 'regSuccess'));


            Yii::$app->session->setFlash('success', Yii::t('site', 'regSuccess'));

            return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());

        }
        elseif (isset($_COOKIE['login_now']) && $_COOKIE['login_now'] == "login_now")
        {
            $attributes = $this->client->getUserAttributes();

            $id = ArrayHelper::getValue($attributes, 'id');

            if (ArrayHelper::getValue($attributes, 'name'))
            {
                $nickname = ArrayHelper::getValue($attributes, 'name');
            }
            else
            {
                $nickname = ArrayHelper::getValue($attributes, 'screen_name');
            }
            $query = User::find()->where("username = '$nickname'")->one();
            if (isset($query) && !empty($query))
            {
                //debug($query->username); die;
                if ($id == $query->social_id);
                {
                    if($query->google_auth === null)
                    {
                        if(Yii::$app->user->login($query, 3600*24*30))
                        {
                            setcookie('login_now', 'login_now', time()+300);
                            if (!isset(Yii::$app->request->cookies['name']) || Yii::$app->request->cookies['name'] != $query->username)
                            {
                                $res = $query->username;
                                setcookie('name', $res, time()+3600*24*30);
                                return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
                            }
                        }
                        else
                        {
                            Yii::$app->session->setFlash('error', Yii::t('site','Incorrect Email.'));
                            return Yii::$app->getResponse()->redirect(Yii::$app->getHomeUrl());
                        }
                    }
                    else
                    {
                        Yii::$app->cache->set('authenticate', $query->google_auth, 300);
                        Yii::$app->cache->set('user', $query, 300);
                        return Yii::$app->getResponse()->redirect('/login');
                    }
                }
            }
            else
            {
                Yii::$app->session->setFlash('error', Yii::t('site','not user'));
                return Yii::$app->getResponse()->redirect('/login');
            }
        }
    }
}