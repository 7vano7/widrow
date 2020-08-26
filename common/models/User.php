<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use common\components\Date;
use yii\rbac\DbManager;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $active
 * @property integer $activate_hash
 * @property integer $role
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    public const STATUS_BLOCKED = '1';
    public const STATUS_ACTIVE = '5';

    public const ACTIVE_FALSE = '1';
    public const ACTIVE_SUCCESS = '5';

    public const ROLE_ADMIN = 'administrator';
    public const ROLE_MANAGER = 'manager';
    public const ROLE_USER = 'user';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors():array
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => (new Date())->now(),
            ]

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
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {

        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function beforeSave($insert)
    {
        if($insert)
        {
            $this->generateAuthKey();
            $this->activate_hash = $this->auth_key;
        }
        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /*
     * Get list of roles
     * @return array
     */
    public function getRoles():array
    {
        return [
            self::ROLE_USER => Yii::t('users', 'user'),
            self::ROLE_MANAGER => Yii::t('users', 'manager'),
            self::ROLE_ADMIN => Yii::t('users', 'admin'),
        ];
    }

    /*
     * Get list of statuses
     * @param integer
     * @return array or string
     */
    public function getStatuses($id = null)
    {
        $array = [
            self::STATUS_BLOCKED => Yii::t('users', 'blocked'),
            self::STATUS_ACTIVE => Yii::t('users', 'active'),

        ];
        if($id)
            return $array[$id];
        return $array;
    }

    /*
     * Get lists of activate user statuses
     * @param integer
     * @return array or string
     */
    public function getActivate($id = null)
    {
        $array = [
            self::ACTIVE_FALSE => Yii::t('users', 'Not activated'),
            self::ACTIVE_SUCCESS => Yii::t('users', 'Activated'),
        ];
        if($id !== null)
            return $array[$id];
        return $array;
    }

    /**
     * Add user role to rbac
     */
    public function afterSave($insert, $changedAttributes):bool
    {
        parent::afterSave($insert, $changedAttributes);
        $rbac = new DbManager;
        if($insert)
        {
            if($rbac->assign($rbac->getRole($this->role), $this->id))
            {
                return true;
            }
        }
        else
        {
            if( isset($changedAttributes['role']) && ($rbac->revokeAll($this->id) && $rbac->assign($rbac->getRole($this->role), $this->id)) ){
                return true;
            }
        }
        return false;
    }

    /**
     * delete user role
     * @params mixed
     * @return bool
     */
    public function beforeDelete():bool
    {
        parent::beforeDelete();
        $this->trigger(self::EVENT_BEFORE_DELETE);

        $rbac = new DbManager;
        if($rbac->revokeAll($this->id))
        {
            return true;
        }
        return false;
    }
}
