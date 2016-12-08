<?php

namespace backend\models\system;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property integer $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property integer $role_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return [
            'default' => ['username', 'password_hash', 'email', 'password_reset_token', 'updated_at'],
            'update' => ['username', 'email', 'password_reset_token', 'updated_at'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password_hash', 'email'], 'required', 'on' => ['default', 'update']],
            [['username', 'password_hash', 'email'], 'trim', 'on' => ['default', 'update']],
//            [['password_hash'], 'required', 'on' => ['create']],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255, 'on' => ['default', 'update']],
            ['password_hash', 'string', 'min' => 6, 'on' => ['default', 'update']],
            [['email'], 'email', 'on' => ['default', 'update']],
            [['email'], 'unique', 'on' => ['default', 'update']],
            [['username'], 'unique', 'on' => ['default', 'update']],
            [['password_reset_token'], 'unique', 'on' => ['default', 'update']],
            ['updated_at', 'default', 'value' => Yii::$app->formatter->asTimestamp('now'), 'on' => ['default', 'update']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('System', 'ID'),
            'username' => Yii::t('System', 'Username'),
            'auth_key' => Yii::t('System', 'Auth Key'),
            'password_hash' => Yii::t('System', 'Password Hash'),
            'password_reset_token' => Yii::t('System', 'Password Reset Token'),
            'email' => Yii::t('System', 'Email'),
            'role_id' => Yii::t('System', 'Auth Rule Name'),
            'status' => Yii::t('System', 'Status'),
            'created_at' => Yii::t('System', 'Created At'),
            'updated_at' => Yii::t('System', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
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
     * @return boolean
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
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
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

    public function afterValidate()
    {
        $userInfo = Yii::$app->request->post();
        if (isset($userInfo['User']['status'])) {
            $this->status = $userInfo['User']['status'];
        }
        if (isset($userInfo['User']['password_hash'])) {
            if ($passwordHash = trim($userInfo['User']['password_hash'])) {
                $this->setPassword($passwordHash);
            }
        }
        parent::afterValidate(); // TODO: Change the autogenerated stub
    }

    public function beforeSave($insert)
    {
        if ($this->isNewRecord) {
            $this->generateAuthKey();
            $this->password_reset_token = Yii::$app->security->generateRandomString();
            $this->status = self::STATUS_ACTIVE;
            $this->created_at = $this->updated_at;
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

    /**
     * @return array
     */
    public function statusLabel()
    {
        return [
            self::STATUS_ACTIVE => Yii::t('System', 'STATUS ACTIVE'),
            self::STATUS_DELETED => Yii::t('System', 'STATUS DELETE'),
        ];
    }

    public function statusStyle()
    {
        return [
            self::STATUS_ACTIVE => 'success',
            self::STATUS_DELETED => 'danger',
        ];
    }
}
