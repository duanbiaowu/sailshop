<?php 
 return array (
  'components' => 
  array (
    'db' => 
    array (
      'class' => 'yii\db\Connection',
      'dsn' => 'mysql:host=127.0.0.1;dbname=sailshop',
      'username' => 'root',
      'password' => 'root',
      'charset' => 'utf8',
      'enableSchemaCache' => false,
      'schemaCacheDuration' => 3600,
      'schemaCache' => 'cache',
    ),
    'urlManager' => 
    array (
      'enablePrettyUrl' => true,
      'showScriptName' => false,
    ),
    'mailer' => 
    array (
      'class' => 'yii\swiftmailer\Mailer',
      'viewPath' => '@common/mail',
      'useFileTransport' => true,
      'transport' => 
      array (
        'class' => 'Swift_SmtpTransport',
        'host' => 'smtp.163.com',
        'username' => 'duanbiaowu@163.com',
        'password' => 'duanbiaowu',
        'port' => '25',
        'encryption' => 'tls',
      ),
      'messageConfig' => 
      array (
        'from' => 
        array (
          'duanbiaowu@163.com' => 'duanbiaowu',
        ),
      ),
    ),
  ),
);