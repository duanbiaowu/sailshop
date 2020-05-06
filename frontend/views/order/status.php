<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

use common\models\order\Order;
use common\models\system\PaymentType;
use yii\helpers\Html;

/* @var Order $model */
/* @var PaymentType[] $paymentTypes */

?>

<link rel="stylesheet" href="/themes/default/css/simple.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/artdialog/artDialog.js?skin=simple"></script>

<div id="widget_sub_navs">
    <ul class="crumbs clearfix mt15 step-4">
        <li>4、订购完成<em></em><i></i></li>
        <li class="pass">3、选择支付<em></em><i></i></li>
        <li class="pass">2、确认订单信息<em></em><i></i></li>
        <li class="pass">1、购物车<em></em><i></i></li>
    </ul>
    <!--- Powered by TinyRise ---></div>
<div class="container">
    <form action="pay?id=<?= $model->id ?>" method="post" id="js-pay-form">
        <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>

        <div class="status-bar" style="font-size: 24px; text-align:center; margin: 20px 0px;">
            <span><i class="icon-success-48"></i>订单已成功提交！</span>
        </div>
        <div class="mt10">
            <table class="table table-line">
                <tbody>
                <tr>
                    <td style="width:200px;">订单编号：</td>
                    <td>
                        <i class="icon-order-0 ie6png"></i>
                        <?= $model->formatId() ?>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="/order/index" target="_blank" class="red">
                            查看订单
                        </a>&nbsp;&nbsp;&nbsp;&nbsp;
                        <a href="javascript:tools_reload()" class=" btn btn-mini" style="display: none;">刷新</a>
                    </td>
                </tr>
                <tr>
                    <td style="width:200px;">订单金额：</td>
                    <td class="red">￥<?= $model->price_count ?></td>
                </tr>
                <tr>
                    <td style="width:200px;">支付方式：</td>
                    <td id="pay_name" class="bold">
                        <?php foreach ($paymentTypes as $paymentType): ?>
                        <?php if ($model->pay_type == $paymentType->id): ?>
                        <?= $paymentType->name ?>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </td>
                </tr>
                <tr>
                    <td style="width:200px;">时间：</td>
                    <td class="red"><?= $model->create_time ?></td>
                </tr>
                </tbody>
            </table>

            <div class="mt10">
                <a href="javascript:;" id="voucher-btn" style="line-height: 32px;height:32px;font-weight:800"><i class="icon-minus-1-16"></i> 其它支付方式：</a>
            </div>

            <div class="clearfix" id="payment-list" style="display: block;">
                <ul class="payment-list">
                    <?php foreach ($paymentTypes as $paymentType): ?>
                        <li <?php if ($model->pay_type == $paymentType->id): ?>class="selected"<?php endif; ?>>
                            <input type="radio" name="payment_id" <?php if ($model->pay_type == $paymentType->id): ?>checked="checked"<?php endif; ?> value="<?= $paymentType->id ?>" payment_name="balance">
                            <label><b><?= $paymentType->name ?></b> </label>
                            <div><img src="<?= $paymentType->logo ?>" width="160" height="50"></div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>

        <div class="blank">
            <p class="tc">
                <button class="btn btn-main" id="js-send-pay-btn" type="button">立即支付</button>
                <a href="/" class="btn btn-gray">继续购书</a>
            </p>
        </div>
    </form>
</div>

<script type="text/javascript">
    $('#js-send-pay-btn').on('click', function() {
        if ($('input[name="payment_id"]').val() !== '1') {
            layer.alert('第三方支付平台接入要求企业认证，为了演示效果，这里直接返回支付成功', {icon: 1}, function () {
                $('#js-pay-form').submit();
            });
        } else {
            $('#js-pay-form').submit();
        }
    });

    $("#voucher-btn").on("click", function () {
        $("#payment-list").toggle();
        if ($("i", this).hasClass("icon-plus-1-16")) {
            $("i", this).removeClass("icon-plus-1-16");
            $("i", this).addClass("icon-minus-1-16");
        } else {
            $("i", this).removeClass("icon-minus-1-16");
            $("i", this).addClass("icon-plus-1-16");
        }
    });
    $("#payment-list input[type='radio']").each(function () {
        if (!!$(this).attr("checked")) $("#pay_name").text($(this).attr("data-name"));
        $(this).on("click", function () {
            $("#pay_name").text($(this).attr("data-name"));

        })
    });

    $(".payment-list li").each(function () {
        $(this).has("input[name='payment_id']:checked").addClass("selected");
        $(this).on("click", function () {
            $(".payment-list li").removeClass("selected");
            $("input[name='payment_id']").removeProp("checked");
            var current_input = $("input[name='payment_id']", this);
            current_input.prop("checked", "checked");
            current_input.trigger('change');
            $("#pay_name").text(current_input.attr("data-name"));
            $(this).addClass("selected");
        });
    });

    $(".payment-note").on("mouseenter", function () {
        if ($(this).attr('note') != '') art.dialog({
            id: 'payment-note',
            cancel: false,
            follow: this,
            content: $(this).attr('note')
        });
    })
    $(".payment-note").on("mouseleave ", function () {
        art.dialog({id: 'payment-note'}).close();
    })
</script>


