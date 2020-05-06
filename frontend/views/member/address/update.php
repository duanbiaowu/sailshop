<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\PasswordResetRequestForm */

/* @var string $testToken */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

?>

<html lang="zh">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link type="text/css" rel="stylesheet" href="/themes/default/css/common.css"/>
    <link type="text/css" rel="stylesheet" href="/themes/default/css/simple.css"/>
    <link rel="stylesheet" href="/themes/default/vendors/awesome/css/font-awesome.min.css">
    <script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/jquery.min.js"></script>
    <script type='text/javascript' src="/themes/default/js/common.min.js"></script>
</head>
<body>
<link rel="stylesheet" type="text/css" href="/themes/default/systemjs/form/style.css"/>
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/artdialog/artDialog.js?skin=brief"></script>
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/artdialog/plugins/iframeTools.js"></script>
<style>
    .tiny-form .line .caption {
        width: 90px;
        line-height: 38px;
        height: 38px;
        background-color: #F8F8F8;
        text-align: left;
        text-overflow: ellipsis;
        overflow: hidden;
        display: inline-block;
        padding: 0 0 0 10px;
    }
</style>

<div style="padding:20px 30px;">
    <form id="address-form" class="tiny-form" action="" method="post">
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
        <ul class="">
            <li class="line">
                <?php if (Yii::$app->session->hasFlash('success')): ?>
                    <div id="field-info" class="alert alert-success" role="alert" style="width: 280px;">
                        <?= Yii::$app->session->getFlash('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (Yii::$app->session->hasFlash('danger')): ?>
                    <div id="field-info" class="alert alert-danger" role="alert" style="width: 280px;">
                        <?= Yii::$app->session->getFlash('danger') ?>
                    </div>
                <?php endif; ?>

                <div>&nbsp;</div>
                <div id="field-info" class="alert alert-danger" style="display: none;" role="alert">
                    两次输入密码不一致
                </div>
            </li>

            <li class="line caption">
                <label class="caption">收货人姓名：</label>
                <input type="text" pattern="required" name="MemberShippingAddress[name]" maxlen="10" class="field" value=""
                       alt="不为空，且长度不得超过10个字">
                <label></label>
            </li>
            <li class="line caption">
                <label class="caption">手机号码：</label>
                <input type="text" class="field" pattern="mobi" name="MemberShippingAddress[mobile]" value="" alt="手机号码格式错误">
                <label></label>
            </li>
            <li class="line other" id="areas">
                <label for="" class="caption">收货地址：</label>
                <select id="province" class="field" name="MemberShippingAddress[province_id]">
                    <option value="0">==省份/直辖市==</option>
                </select>
                <select id="city" class="field" name="MemberShippingAddress[city_id]">
                    <option value="0">==市==</option>
                </select>
                <select id="county" class="field" name="MemberShippingAddress[district_id]">
                    <option value="0">==县/区==</option>
                </select>
                <input pattern="^\d+,\d+,\d+$" id="test" type="text" style="visibility:hidden;width:0;" value="0,0,0" alt="请选择完整地区信息！">
                <label></label>
            </li>
            <li class="line caption">
                <label class="caption">邮政编码：</label>
                <input class="field" type="text" name="MemberShippingAddress[remark]" pattern="zip" value="" alt="邮政编码错误">
            </li>
            <li class="line other">
                <label for="" class="caption">设为默认：</label>
                <input type="checkbox" id="is_default" class="magic-checkbox" name="MemberShippingAddress[is_default]" value="1"> <label
                        for="is_default">设置为默认收货地址</label>
            </li>
            <li class="line textarea">
                <label class="caption">街道地址：</label>
                <textarea name="MemberShippingAddress[detail_address]" pattern="required" minlen="5" maxlen="120" alt="不需要重复填写省市区，必须大于5个字符，小于120个字符"
                          style="width: 612px;"></textarea>
                <label></label>
            </li>
            <li class="line">
                <input type="hidden" name="MemberShippingAddress[province_name]" value="" />
                <input type="hidden" name="MemberShippingAddress[city_name]" value="" />
                <input type="hidden" name="MemberShippingAddress[district_name]" value="" />
                <input type="submit" class="btn btn-main" value="提交">
            </li>
        </ul>
    </form>
</div>

<script type="text/javascript">
    var form = new Form('address-form');
    form.setValue('is_default', '');
    $("#areas").Linkage({
        url: "/themes/default/js/area.js", selected: [0, 0, 0], callback: function (data) {
            var text = [];
            var value = [];
            for (i in data[0]) {
                if (data[0][i] != 0) {
                    text.push(data[1][i]);
                    value.push(data[0][i]);
                }
            }
            $("#test").val(value.join(','));
            FireEvent(document.getElementById("test"), "change");
        }
    });

    $('#address-form').on('submit', function() {
        $('input[name="MemberShippingAddress[province_name]"]').val( $('#province').find("option:selected").text() );
        $('input[name="MemberShippingAddress[city_name]"]').val( $('#city').find("option:selected").text() );
        $('input[name="MemberShippingAddress[district_name]"]').val( $('#county').find("option:selected").text() );
        return true;
    });

</script>
</body>
</html>


