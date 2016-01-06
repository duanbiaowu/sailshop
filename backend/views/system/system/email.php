<?php
/**
 * @name Launch shop system
 * @copyright Copyright (c) 2015-2099
 * @author: 游梦惊园
 * @blog: www.codean.net
 * @version 1.0
 * @date: 2015-11-06
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '邮箱设置';
$this->params['breadcrumbs'][] = $this->title;

?>

<?php $form = ActiveForm::begin([
    'id' => 'email-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
    ],
]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            <?= Html::encode($this->title); ?>
        </div>
        <div class="panel-body">

            <?= $form->field($model, 'address')->hint('SMTP服务器为发送邮件的服务器。如: smtp.163.com'); ?>

            <?= $form->field($model, 'port')->hint('SMTP服务器端口，默认为25。具体信息请查看对应服务器官方说明'); ?>

            <?= $form->field($model, 'username')->hint('请填写发送者的邮箱地址'); ?>

            <?= $form->field($model, 'password')->hint('请填写发送者都邮箱密码'); ?>

            <?= $form->field($model, 'fromUser')->hint('请填写发送者名字'); ?>

            <?= $form->field($model, 'testAddress')->hint('请填写测试接受邮箱地址'); ?>

        </div>
    </div>

    <div class="form-group col-sm-12">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary col-sm-1', 'name' => 'type', 'value' => 'save']); ?>
        <div class="col-sm-1"></div>
        <?= Html::submitButton('<span class="glyphicon glyphicon-send" aria-hidden="true"></span> 测试发送', ['class' => 'btn btn-primary', 'name' => 'type', 'value' => 'test']); ?>
    </div>

<?php ActiveForm::end(); ?>