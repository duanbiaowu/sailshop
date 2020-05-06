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
    <form action="/index.php?con=simple&amp;act=forget_act" class="tiny-form simple-box" method="post"
          novalidate="true">
        <ul class="">
            <li class="line icon"><span class="caption perfix fa"></span><input class="field"
                                                                                         name="account" id="account"
                                                                                         pattern="required"
                                                                                         placeholder="邮箱/手机号码"
                                                                                         inform="0" initmsg="邮箱/手机号码">
                <label class="invalid-msg"></label></li>
            <li class="line icon"><span class="caption perfix fa"></span><input type="text"
                                                                                         class="field"
                                                                                         name="verifyCode"
                                                                                         id="verifyCode" pattern="\w{4}"
                                                                                         maxlength="4"
                                                                                         style="width: 80px;"
                                                                                         placeholder="验证码" inform="0"
                                                                                         initmsg=""><label
                        style="display:none" class="invalid-msg">验证码错误！</label><img id="captcha_img"
                                                                                    src="/index.php?con=simple&amp;act=captcha&amp;h=40&amp;w=120"><label><a
                            href="javascript:void(0)" class="red"
                            onclick="document.getElementById('captcha_img').src='/index.php?con=simple&amp;act=captcha&amp;h=40&amp;w=120&amp;random='+Math.random()">换一张</a></label>
            </li>
            <li class="line"><input type="submit" class=" btn btn-main" value="找回密码"></li>
        </ul>
    </form>
</div>
<script type="text/javascript">

    $("input[pattern]").on("blur", function (event) {
        var current_input = $(this);
        var result = autoValidate.validate(event);
        if (result) {
            current_input.parent().removeClass('invalid').addClass('valid');
        } else {
            current_input.parent().removeClass('valid').addClass('invalid');
        }
    });
    $("input[name='account']").on("blur", function (event) {
        var current_input = $(this);
        if (autoValidate.validate(event)) {
            $.post("/index.php?con=ajax&act=account&account=" + $(this).val(), function (data) {
                var msg = '此账户不存在!';
                if (!data['status']) {
                    msg = '账户合法!';
                    current_input.next().show();
                    current_input.parent().removeClass('invalid').addClass('valid');
                } else {
                    current_input.parent().removeClass('valid').addClass('invalid');
                }
                autoValidate.showMsg({id: document.getElementById('account'), error: data['status'], msg: msg});
            }, 'json');
        }
    });
    $("input[name='verifyCode']").on("blur", function () {
        var current_input = $(this);
        $.post("/index.php?con=ajax&act=verifyCode&verifyCode=" + $(this).val(), function (data) {
            if (data['status']) {
                current_input.parent().removeClass('invalid').addClass('valid');
            } else {
                current_input.parent().removeClass('valid').addClass('invalid');
            }
            autoValidate.showMsg({id: document.getElementById('verifyCode'), error: !data['status'], msg: data['msg']});
        }, 'json');
    })

</script>