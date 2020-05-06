<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<link type="text/css" rel="stylesheet" href="/themes/default/css/ucenter.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>

<div class="container list blank">
    <div class="row-5">
        <?= $this->render('_menu') ?>

        <div class="col-4">
            <h1 class="title"><span>修改登录密码</span></h1>
            <div class="simple-box ">
                <form action="" formmsg="field-info" name="form_update" class="simple" method="post" novalidate="true">
                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

                    <ul class="tiny-form  hidden-msg">
                        <li class="line">
                            <?php if (Yii::$app->session->hasFlash('success')): ?>
                                <div id="field-info" class="alert alert-success" role="alert" style="width: 335px;">
                                    <?= Yii::$app->session->getFlash('success') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (Yii::$app->session->hasFlash('danger')): ?>
                                <div id="field-info" class="alert alert-danger" role="alert" style="width: 335px;">
                                    <?= Yii::$app->session->getFlash('danger') ?>
                                </div>
                            <?php endif; ?>

                            <div>&nbsp;</div>
                            <div id="field-info" class="alert alert-danger" style="display: none;" role="alert">
                                两次输入密码不一致
                            </div>
                        </li>
                        <li class="line icon"><label class="caption perfix fa"></label><input bind="oldPassword"
                                                                                               minlen="6" maxlen="20"
                                                                                               class="field invalid-text"
                                                                                               type="password"
                                                                                               name="oldPassword"
                                                                                               pattern="required"
                                                                                               placeholder="请输入密码"
                                                                                               alt="6-20任意字符组合"
                                                                                               inform="1" initmsg="">
                        </li>
                        <li class="line icon"><label class="caption perfix fa"></label><input bind="repassword"
                                                                                               minlen="6" maxlen="20"
                                                                                               class="field invalid-text"
                                                                                               type="password"
                                                                                               name="password"
                                                                                               pattern="required"
                                                                                               placeholder="请输入新密码"
                                                                                               alt="6-20任意字符组合"
                                                                                               inform="1"
                                                                                               initmsg=""><label
                                    class="invalid-msg">两次输入密码不一致</label></li>
                        <li class="line icon"><label class="caption perfix fa"></label><input bind="password"
                                                                                               minlen="6" maxlen="20"
                                                                                               class="field invalid-text"
                                                                                               type="password"
                                                                                               name="repassword"
                                                                                               pattern="required"
                                                                                               placeholder="请再次输入新密码"
                                                                                               alt="6-20任意字符组合"
                                                                                               inform="1"
                                                                                               initmsg=""><label
                                    class="invalid-msg">两次输入密码不一致</label></li>
                        <li>
                            <div id="msgInfo"></div>
                        </li>
                        <li class="line"><input type="submit" name="" class="btn btn-main" value="提交修改"></li>
                    </ul>
                </form>
            </div>
        </div>
    </div>
</div>
