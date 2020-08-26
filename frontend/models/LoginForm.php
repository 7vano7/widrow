<?php
namespace frontend\models;

use Yii;

/**
 * Login form
 */
class LoginForm extends \common\models\LoginForm
{
    public $email;
    public $password;
    public $rememberMe = true;
    public $google_auth;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['email', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['email', 'validateEmail'],
            ['password', 'validatePassword'],
            ['google_auth', 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'email'=>Yii::t('site', 'Email'),
            'password'=>Yii::t('site', 'Password'),
            'rememberMe'=>Yii::t('site', 'Remember me'),
            'google_auth'=>Yii::t('site', 'Google auth'),
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, Yii::t('site','Incorrect Password.'));
                //echo 'no';die;
            }
            else
            {
                if ($user->google_auth) {
                    // setcookie('authenticate', $user->google_auth, time() + 300);
                    Yii::$app->cache->set('authenticate', $user->google_auth, 300);
                }
            }
        }
    }

    /**
     * Validates the eamil.
     * This method serves as the inline validation for email.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validateEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user) {
                $this->addError($attribute, Yii::t('site','Incorrect Email.'));
            }
            elseif($user->active == $user::ACTIVE_FALSE)
            {
                $this->addError($attribute, Yii::t('site','Not activate'));
            }
            elseif($user->status === $user::STATUS_BLOCKED)
            {
                $this->addError($attribute, Yii::t('site','Status blocked'));
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        // if ($this->validate()) {
        return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        // }

//        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = SignupForm::findByEmail($this->email);
        }

        return $this->_user;
    }
}

