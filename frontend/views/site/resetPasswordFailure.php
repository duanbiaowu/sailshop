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
        <li class="pass">4、完成<em></em><i></i></li>
        <li class="pass">3、设置新密码<em></em><i></i></li>
        <li class="pass">2、验证身份<em></em><i></i></li>
        <li class="pass">1、填写账户信息<em></em><i></i></li>
    </ul>
    <!--- Powered by TinyRise --->
</div>

<div class="container" style="margin-top: 50px; margin-left: 25%;">
    <div class="simple-box">
        <div class="status-bar" style="font-size: 18px;">
            <i class='icon-error-48'></i><span>密码设置失败，重置密码链接失效！</span>
        </div>
        <div class="blank">
            <p></p>
        </div>
        <div><a href="/site/index" class="btn btn-main">返回首页</a></div>
    </div>
</div>