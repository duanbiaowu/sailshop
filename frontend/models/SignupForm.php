<?php
namespace frontend\models;

use common\models\Member;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\Member', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\Member', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Signs user up.
     *
     * @return Member|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $member = new Member();
            $member->username = $this->username;
            $member->email = $this->email;
            $member->setPassword($this->password);
            $member->generateAuthKey();
            if ($member->save()) {
                return $member;
            }
        }

        return null;
    }
}
