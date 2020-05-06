<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\SignupForm */

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="login-bg">
    <div class="container list">
        <div class="row-4">
            <div class="col-2">
                <div class="login-box" style="width:360px;">
                    <form action="/site/register" class="tiny-form  hidden-msg" method="post"
                          callback="checkReadme" formmsg="field-info" novalidate="true">

                        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

                        <li class="line ">
                            <?php if (Yii::$app->session->hasFlash('danger')): ?>
                                <div id="field-info" class="alert alert-danger" style="" role="alert">
                                    <?= Yii::$app->session->getFlash('danger') ?>
                                </div>
                            <?php endif; ?>

                            <div class="clearfix"><span class="fl">会员注册</span><a class="fr"
                                                                                 href="/site/login">立即登录</a>
                            </div>
                            <div id="field-info" class="alert alert-danger" style="display:none" role="alert">
                            </div>
                        </li>
                        <ul>
                            <li class="line icon"><span class="caption perfix fa"></span>
                                <input name="SignupForm[username]" id="username" class="field" pattern="required" minlen="2" maxlen="255"
                                       placeholder="请输入用户名" alt="用户名格式不正确!" inform="0">
                            </li>
                            <li class="line icon"><span class="caption perfix fa"></span>
                                <input name="SignupForm[email]" id="email" class="field" pattern="email"
                                       placeholder="请输入邮箱" alt="邮箱格式不正确!" inform="0">
                            </li>
                            <li class="line icon">
                                <span class="caption perfix fa"></span>
                                <input bind="repassword" minlen="6" maxlen="20" class="field" type="password"
                                       name="SignupForm[password]" pattern="required" placeholder="请输入密码" alt="6-20任意字符组合" inform="0">
                            </li>
                            <li class="line icon">
                                <span class="caption perfix fa"></span>
                                <input bind="password" minlen="6" maxlen="20" class="field" type="password"
                                       name="repassword" pattern="required" placeholder="确认密码" alt="6-20任意字符组合"
                                       inform="0">
                            </li>
                            <li class="line icon">
                                <span class="caption perfix fa"></span>
                                <input type="text" class="field" name="verifyCode" id="verifyCode" pattern="\w{4,10}"
                                       maxlength="10" style="width:117px; " alt="验证码不正确" inform="0">
                                <label style="position: absolute;display:none ;left:-100px;">

                                </label>
                                    <img src="/site/captcha" id="js-captcha-img" style="height: 40px;">
                                <label>
                                    <a href="javascript:void(0)" class="red" id="js-switch-code-btn">换一张</a>
                                </label>
                            </li>
                            <li class="line">
                                <input id="readme" type="checkbox" alt="同意后才可注册">
                                <label></label>
                                <label>我已阅读并同意《<a class="" id="user-license"
                                                  href="javascript:;">扬帆书店用户注册协议</a>》</label>
                            </li>
                            <li>
                                <button type="submit" class="btn btn-main" style="padding:10px 40px; width:100%">同意协议，立即注册</button>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>
</div>
<div id="license-content" style="display:none;">
    <div style="padding:20px;">
        <p>
            演示内容，请尽快完善用户注册协议。
        </p></div>
</div>


<link rel="stylesheet" type="text/css" href="/themes/default/systemjs/form/style.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>

<script type="text/javascript">
    var readLayer = null;
    $("#user-license").on("click", function () {
        readLayer = layer.open({
            id: 'license-dialog',
            title: "扬帆书店用户注册协议",
            type: 1,
            area: ['820px', '440px'], //宽高
            content: document.getElementById('license-content').innerHTML,
            btn: ['同意用户注册协议'],
            yes: function (index, layero) {
                closeLicense();
            }
        });
    });

    function closeLicense() {
        $('#readme').prop("checked", 'true');
        autoValidate.showMsg({id: document.getElementById('readme'), error: false, msg: ''});
        layer.close(readLayer);
    }

    $("#sendSMS").click(function () {
        var data = 'mobile=' + $("#mobile").val() + '&r=' + Math.random();
        if (autoValidate.validate(document.getElementById('mobile')) === false) return;

        $.ajax({
            type: "get",
            url: "/index.php?con=ajax&act=send_sms",
            data: data,
            dataType: 'json',
            success: function (result) {
                if (result['status'] == 'success') {
                    $('#mobile').attr("readonly", "readonly");
                    var send_sms = $("#sendSMS");
                    send_sms.attr("disabled", true);
                    send_sms.addClass("btn-disable");
                    var i = 120;
                    send_sms.val(i + '秒后重新获取');
                    var timer = setInterval(function () {
                        i--;
                        send_sms.val(i + '秒后重新获取');
                        if (i <= 0) {
                            clearInterval(timer);
                            send_sms.val('获取短信验证码');
                            $('#mobile').removeAttr("readonly");
                            send_sms.removeClass("btn-disable");
                            send_sms.attr("disabled", false);
                        }
                    }, 1000);
                } else {
                    art.dialog.tips("<p class='fail'>" + result['msg'] + "</p>");
                }
            }
        });
    });

    // $("input[name='email']").on("change", function (event) {
    //     if (autoValidate.validate(event)) {
    //         $.post("/index.php?con=ajax&act=email&email=" + $(this).val(), function (data) {
    //             autoValidate.showMsg({id: document.getElementById('email'), error: !data['status'], msg: data['msg']});
    //         }, 'json');
    //     }
    // });
    //
    // $("input[name='mobile']").on("change", function (event) {
    //     if (autoValidate.validate(event)) {
    //         $.post("/index.php?con=ajax&act=mobile&mobile=" + $(this).val(), function (data) {
    //             autoValidate.showMsg({id: document.getElementById('mobile'), error: !data['status'], msg: data['msg']});
    //         }, 'json');
    //     }
    // });
    //
    // $("input[name='verifyCode']").on("change", function () {
    //     $.post("/index.php?con=ajax&act=verifyCode&verifyCode=" + $(this).val(), function (data) {
    //         autoValidate.showMsg({id: document.getElementById('verifyCode'), error: !data['status'], msg: data['msg']});
    //     }, 'json');
    // })

    $('#js-switch-code-btn').on('click', function() {
        $.get('/site/captcha?refresh=1', {}, function(response) {
            $('#js-captcha-img').attr('src', response.url);
        }, 'json')
    });


    $("#readme").on("change", function () {
        if ($("#readme:checked").length > 0) autoValidate.showMsg({
            id: document.getElementById('readme'),
            error: false,
            msg: ''
        });
        else autoValidate.showMsg({id: document.getElementById('readme'), error: true, msg: '同意后才可注册'});
    });

    function checkReadme(e) {
        if (e) return false;
        else {
            if ($('#readme').is(':checked')) return true;
            else {
                autoValidate.showMsg({id: document.getElementById('readme'), error: true, msg: '同意后才可注册'});
                return false;
            }
        }
    }

    $("input[pattern]").on("blur", function (event) {
        var current_input = $(this);
        var result = autoValidate.validate(event);
        if (result) {
            if (current_input.attr('id') === 'username') {
                $.get("/site/validate-username?username=" + $(this).val(), function (data) {
                    var msg = '合法用户';
                    if (!data['status']) {
                        msg = '用户已存在';
                    }
                    autoValidate.showMsg({id: document.getElementById('username'), error: !data['status'], msg: msg});
                }, 'json');
            }

            if (current_input.attr('id') === 'email') {
                $.get("/site/validate-email?email=" + $(this).val(), function (data) {
                    var msg = '合法用户';
                    if (!data['status']) {
                        msg = '用户已存在';
                    }
                    autoValidate.showMsg({id: document.getElementById('email'), error: !data['status'], msg: msg});
                }, 'json');
            }
            if (current_input.attr('id') === 'mobile') {
                $.post("/index.php?con=ajax&act=mobile&mobile=" + $(this).val(), function (data) {
                    var msg = '合法用户';
                    if (!data['status']) {
                        msg = '用户已存在';
                    }
                    autoValidate.showMsg({id: document.getElementById('mobile'), error: !data['status'], msg: msg});
                }, 'json');
            } else if (current_input.attr('id') === 'verifyCode') {
                // $.get("/site/validate-code?code=" + $(this).val(), {}, function (data) {
                //     autoValidate.showMsg({
                //         id: document.getElementById('verifyCode'),
                //         error: !data['status'],
                //         msg: '验证码错误'
                //     });
                // }, 'json');
            }
        }
    });
</script>

