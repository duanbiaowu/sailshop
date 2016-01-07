<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-10-28
 */

namespace backend\models\system;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;
use common\models\User;
use yii\db\IntegrityException;
use yii\web\IdentityInterface;

class ResetPasswordForm extends Model
{
    public $password;

    public $new_password;

    public $repeat_password;

    /**
     * @var \common\models\User
     */
    private $_user;

    public function rules()
    {
        return [
            [['password', 'new_password', 'repeat_password'], 'required'],
            ['new_password', 'string', 'min' => 6],
            ['repeat_password', 'compare', 'compareAttribute' => 'new_password']
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => Yii::t('User', 'form_password'),
            'new_password' => Yii::t('User', 'form_new_password'),
            'repeat_password' => Yii::t('User', 'form_repeat_password'),
        ];
    }


    public function resetPassword()
    {
        $this->_user = User::findIdentity(Yii::$app->user->id);

        if (!Yii::$app->getSecurity()->validatePassword($this->password, $this->_user->password_hash)) {
            throw new InvalidParamException(Yii::t('User', 'source_password_error'));
        }

        $this->_user->setPassword($this->new_password);

        return $this->_user->save(false);
    }
}

