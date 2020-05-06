<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\PasswordResetRequestForm */
/* @var string $testToken */

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
    <div class="simple-box">
        <div class="message">
            <div class="status-bar">
                <i class="icon-error-48"></i><span>密码重置链接已过期。</span>
            </div>
            <div class="line tc"><a href="/site/index" class="btn btn-main">返回首页</a></div>
        </div>
    </div>
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
                if (data['status']) {
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