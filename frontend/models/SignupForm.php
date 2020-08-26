<?php
namespace frontend\models;

use common\models\User;
use Yii;

/**
 * Signup form
 */
class SignupForm extends User
{
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('site','ID'),
            'created_at' => Yii::t('site','Created'),
            'updated_at' => Yii::t('site','Updated'),
            'username' => Yii::t('site','Username'),
            'password_hash' => Yii::t('site','Password'),
            'email' => Yii::t('site','Email'),
            'role' => Yii::t('site','Role'),
            'status' => Yii::t('site','Status'),
            'active' => Yii::t('site','Active'),
            'google_auth' => Yii::t('users','Google auth'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('site', 'This username has already been taken.')],
            ['username', 'string', 'min' => 4, 'max' => 255],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('site', 'This email address has already been taken.')],
            ['password_hash', 'required'],
            [['password_hash', 'google_auth'], 'string', 'min' => 6],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_BLOCKED]],
            ['active', 'default', 'value' => self::ACTIVE_FALSE],
            ['active', 'in', 'range' => [self::ACTIVE_FALSE, self::ACTIVE_SUCCESS]],
            ['role', 'default', 'value' => self::ROLE_USER],
            ['role', 'in', 'range' => [self::ROLE_USER, self::ROLE_MANAGER, self::ROLE_ADMIN]],

        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setpassword_hash($this->password_hash);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
