<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<link rel="stylesheet" type="text/css" href="/themes/default/systemjs/form/style.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>

<div id="widget_sub_navs"><ul class="crumbs clearfix mt15 step-4">
        <li>4、完成<em></em><i></i></li>
        <li class="pass">3、设置新密码<em></em><i></i></li>
        <li class="pass">2、验证身份<em></em><i></i></li>
        <li class="pass">1、填写账户信息<em></em><i></i></li>
    </ul>
    <!--- Powered by TinyRise --->
</div>

<div class="container" style="margin-top: 50px; margin-left: 25%;">
    <div class="simple-box ">
        <div>
            <form class="tiny-form" action="" method="post" novalidate="true">
                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                <ul>
                    <li class="line icon"><span class="caption fa"></span><input bind="ResetPasswordForm[repassword]" minlen="6" maxlen="20" class="field" type="password" name="ResetPasswordForm[password]" pattern="required" placeholder="新密码" alt="6-20任意字符组合" inform="0"></li>
                    <li class="line icon"><span class="caption fa"></span><input bind="ResetPasswordForm[password]" minlen="6" maxlen="20" class="field" type="password" name="ResetPasswordForm[repassword]" pattern="required" placeholder="确认新密码" alt="6-20任意字符组合" inform="0"></li>
                    <li class="line">
                        <input type="submit" class="btn btn-main" value="设定新密码">
                    </li>
                </ul>
            </form>
        </div>
    </div>
</div>