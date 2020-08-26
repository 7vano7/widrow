<?php

namespace frontend\modules\admin\models;

use Yii;

class User extends \common\models\User
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('users', 'This username has already been taken.'),'on'=>'insert'],
            ['username', 'unique', 'filter'=>['!=', 'id', $this->id], 'targetClass' => '\common\models\User', 'message' => Yii::t('users', 'This username has already been taken.')],
            ['username', 'string', 'min' => 4, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => Yii::t('users', 'This email address has already been taken.'), 'on'=>'insert'],
            ['email', 'unique', 'filter'=>['!=', 'id', $this->id], 'targetClass' => '\common\models\User', 'message' => Yii::t('users', 'This email address has already been taken.')],

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
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('admin','ID'),
            'created_at' => Yii::t('admin','Created'),
            'updated_at' => Yii::t('admin','Updated'),
            'username' => Yii::t('users','Username'),
            'password_hash' => Yii::t('users','Password'),
            'email' => Yii::t('users','Email'),
            'role' => Yii::t('users','Role'),
            'status' => Yii::t('users','Status'),
            'active' => Yii::t('users','Active'),
            'google_auth' => Yii::t('users','Google auth'),
        ];
    }

    /**
     * Get list of users
     * @return array
     */
    public function getList():array
    {
        $result = [];
        $model = self::find()->all();
        if($model)
        {
            foreach($model as $lang)
            {
                $result[$lang['id']] = $lang['username'];
            }
        }
        return $result;
    }
}