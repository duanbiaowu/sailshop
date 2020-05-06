<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Modal;

$this->title = '管理员登录';

?>
<div class="site-login">
    <div class="col-sm-4"></div>
    <div class="col-sm-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= Html::encode($this->title) ?>
            </div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'options' => ['class' => 'form-horizontal'],
                    'fieldConfig' => [
                        'labelOptions' => ['class' => 'col-sm-1 control-label'],
                        'template' => '{label} <div class="col-sm-10">{input}{error}{hint}</div>',
                    ],
                ]); ?>

                <?= $form->field($model, 'username')->input('text', ['placeholder' => '请输入管理员帐号']) ?>

                <?= $form->field($model, 'password')->input('password', ['placeholder' => '请输入管理员密码']) ?>

                <?= $form->field($model, 'rememberMe', [
                    'template' => '<label class="col-sm-1"></label><div class="col-sm-5"><label class="checkbox-inline">{input}{label}</label></div>{error}{hint}',
                ])->checkbox(['label' => '记住用户名'], false) ?>

                <div class="form-group">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-10">
                <?= Html::submitButton('登录', ['class' => 'btn btn-primary col-sm-12', 'name' => 'login-button']) ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
