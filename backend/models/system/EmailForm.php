<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-11-25
 */

namespace backend\models\system;

use Yii;
use yii\base\Model;
use yii\base\InvalidParamException;

class EmailForm extends Model
{
    public $address;
    public $ssl;
    public $port;
    public $username;
    public $password;
    public $fromUser;
    public $testAddress;

    public function scenarios()
    {
        return [
            'save' => ['address', 'port', 'username', 'password', 'fromUser'],
            'test' => ['address', 'port', 'username', 'password', 'fromUser', 'testAddress'],
        ];
    }

    public function rules()
    {
        return [
            [['address', 'port', 'username', 'password', 'fromUser'], 'required', 'on' => ['save', 'test']],
            [['testAddress'], 'required', 'on' => 'test'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'address' => Yii::t('System', 'form_email_address'),
            'ssl' => Yii::t('System', 'form_email_ssl'),
            'port' => Yii::t('System', 'form_email_port'),
            'username' => Yii::t('System', 'form_email_username'),
            'password' => Yii::t('System', 'form_email_password'),
            'fromUser' => Yii::t('System', 'form_email_from_user'),
            'testAddress' => Yii::t('System', 'form_email_test_address'),
        ];
    }

    public function sendMail()
    {
        $mailer = [
            'mailer' => [
                'class' => 'yii\swiftmailer\Mailer',
                'viewPath' => '@common/mail',
                'transport' => [
                    'class' => 'Swift_SmtpTransport',
                    'host' => $this->address,
                    'username' => $this->username,
                    'password' => $this->password,
                    'port' => $this->port,
                    'encryption' => 'tls',
                ],
                'messageConfig'=> [
                    'charset' => 'UTF-8',
                    'from'=>[
                        $this->username => $this->fromUser,
                    ],
                ],
                'useFileTransport' => false,
            ],
        ];

        Yii::$app->setComponents($mailer);

        // 测试发送邮件代码
        return true;

        try {
            return Yii::$app->mailer->compose()
                ->setTo($this->testAddress)
                ->setSubject(Yii::t('System', 'email_test_subject'))
                ->setTextBody(Yii::t('System', 'email_test_body'))
                ->send();
        } catch (\Swift_TransportException $e) {
            throw new InvalidParamException(Yii::t('System', 'email_config_has_error'));
        }
    }

    public function saveConfig()
    {
        $components = require(__DIR__ . '/../../../common/config/main-local.php');

        $components['components']['mailer']['transport'] = [
            'class' => 'Swift_SmtpTransport',
            'host' => $this->address,
            'username' => $this->username,
            'password' => $this->password,
            'port' => $this->port,
            'encryption' => 'tls',
        ];

        $components['components']['mailer']['messageConfig']['from'] = [
            $this->username => $this->fromUser,
        ];

        $components = "<?php \n return " . var_export($components, true) . ';';
        $components = str_replace('\\\\', '\\', $components);

        return file_put_contents(Yii::getAlias('@common/config/main-local.php'), $components);
    }
}