<?php
namespace frontend\models;

use common\models\Member;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => '\common\models\Member',
                'filter' => ['status' => Member::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * 发送重置密码邮件
     * 测试效果： 不真正发送邮件
     * @return boolean
     */
    public function sendEmail()
    {
        /**
         * @var $user Member
         */
        $user = Member::findOne([
            'status' => Member::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            if (!Member::isPasswordResetTokenValid($user->password_reset_token)) {
                $user->generatePasswordResetToken();
            }

            if ($user->save()) {
                // 测试发送邮件代码
                return $user->password_reset_token;

                // 真实发送邮件代码
//                return \Yii::$app->mailer->compose(['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'], ['user' => $user])
//                    ->setFrom([\Yii::$app->params['supportEmail'] => \Yii::$app->name . ' robot'])
//                    ->setTo($this->email)
//                    ->setSubject('Password reset for ' . \Yii::$app->name)
//                    ->send();
            }
        }

        return false;
    }
}
