<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model MemberLoginForm */

use common\models\MemberLoginForm;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>


<link rel="stylesheet" type="text/css" href="/themes/default/systemjs/form/style.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>
<div class="login-bg">
    <div class="container list">
        <div class="row-5 ">
            <div class="col-3">&nbsp;</div>
            <div class="col-2">
                <div class="login-box">
                    <form action="/site/login" class="tiny-form hidden-msg" method="post"
                          callback="checkReadme" formmsg="field-info" novalidate="true">

                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

                        <ul>
                            <li class="line ">
                                <?php if (Yii::$app->session->hasFlash('danger')): ?>
                                <div id="field-info" class="alert alert-danger" style="" role="alert">
                                    <?= Yii::$app->session->getFlash('danger') ?>
                                </div>
                                <?php endif; ?>

                                <div class="clearfix"><span class="fl">会员登录</span><a class="fr"
                                                                                     href="/site/register">立即注册</a>
                                </div>
                                <div id="field-info" class="alert alert-danger" style="display:none" role="alert">
                                </div>
                            </li>
                            <li class="line icon">
                                <label class="caption perfix fa"></label>
                                <input name="MemberLoginForm[username]" id="account" value="" class="field" pattern="required"
                                       placeholder="用户名" alt="账号不能为空！" inform="0">
                                <label></label>
                            </li>
                            <li class="line icon"><span class="caption perfix fa"></span>
                                <input class="field" name="MemberLoginForm[password]" type="password" placeholder="密码" pattern="required"
                                       alt="密码不能为空" inform="0">
                            </li>
                            <li class="line">
                                <input name="MemberLoginForm[rememberMe]" id="readme" type="checkbox" value="1">
                                <label for="readme">自动登录</label>
                                <label class="fr">
                                    [<a href="/site/request-password-reset">忘记密码?</a>]
                                </label>
                            </li>
                            <li class="line">
                                <button class="btn btn-main " style="width:100%">登录</button>
                            </li>
                        </ul>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
