<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>


<link rel="stylesheet" type="text/css" href="/themes/default/systemjs/form/style.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>

<div id="widget_sub_navs">
    <ul class="crumbs clearfix mt15 step-4">
        <li>4、完成<em></em><i></i></li>
        <li>3、设置新密码<em></em><i></i></li>
        <li>2、验证身份<em></em><i></i></li>
        <li class="pass">1、填写账户信息<em></em><i></i></li>
    </ul>
    <!--- Powered by TinyRise ---></div>
<div class="container blank" style="margin-top: 50px; margin-left: 25%;">
    <form action="" class="tiny-form simple-box" method="post" novalidate="true">
        <ul class="">
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

            <li class="line" style="width: 355px;">
                <?php if (Yii::$app->session->hasFlash('danger')): ?>
                    <div id="field-info" class="alert alert-danger" style="" role="alert">
                        <?= Yii::$app->session->getFlash('danger') ?>
                    </div>
                <?php endif; ?>

                <div class="clearfix">
                    <span class="fl">&nbsp;&nbsp;</span><a class="fr" href="/site/login">&nbsp;&nbsp;</a>
                </div>

            </li>

            <li class="line icon">

                <span class="caption perfix fa">&#xf007;</span>
                <input class="field" name="PasswordResetRequestForm[email]" id="email" pattern="required" placeholder="邮箱/手机号码">
                <label>邮箱/手机号码</label>
            </li>
            <li class="line icon"><span class="caption perfix fa">&#xf02a;</span><input type="text" class="field"
                                                                                        name="verifyCode"
                                                                                        pattern="\w{4,10}"
                                                                                        maxlength="10"
                                                                                        style="width: 150px;"
                                                                                        placeholder="验证码"><label
                        style="display:none"></label>
                <img src="/site/captcha" id="js-captcha-img" style="height: 40px;">
                <label>
                    <a href="javascript:void(0)" class="red" id="js-switch-code-btn">换一张</a>
                </label>
            </li>
            <li class="line"><input type="submit" class=" btn btn-main" value="找回密码"></li>
        </ul>
    </form>
</div>

<script type="text/javascript">

    $('#js-switch-code-btn').on('click', function () {
        $.get('/site/captcha?refresh=1', {}, function (response) {
            $('#js-captcha-img').attr('src', response.url);
        }, 'json')
    });

    $("input[pattern]").on("blur", function (event) {
        var current_input = $(this);
        var result = autoValidate.validate(event);
        if (result) {
            current_input.parent().removeClass('invalid').addClass('valid');
        } else {
            current_input.parent().removeClass('valid').addClass('invalid');
        }
    });
    $("input[name='email']").on("blur", function (event) {
        var current_input = $(this);
        if (autoValidate.validate(event)) {
            $.get("/site/validate-email?email=" + $(this).val(), function (data) {
                var msg = '此账户不存在!';
                if (!data['status']) {
                    msg = '账户合法!';
                    current_input.next().show();
                    current_input.parent().removeClass('invalid').addClass('valid');
                } else {
                    current_input.parent().removeClass('valid').addClass('invalid');
                }
                autoValidate.showMsg({id: document.getElementById('email'), error: data['status'], msg: msg});
            }, 'json');
        }
    });
    // $("input[name='verifyCode']").on("blur", function () {
    //     var current_input = $(this);
    //     $.post("/index.php?con=ajax&act=verifyCode&verifyCode=" + $(this).val(), function (data) {
    //         if (data['status']) {
    //             current_input.parent().removeClass('invalid').addClass('valid');
    //         } else {
    //             current_input.parent().removeClass('valid').addClass('invalid');
    //         }
    //         autoValidate.showMsg({id: document.getElementById('verifyCode'), error: !data['status'], msg: data['msg']});
    //     }, 'json');
    // })

</script>