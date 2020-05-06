<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

use common\models\goods\Book;
use common\models\MemberShippingAddress;
use common\models\system\PaymentType;
use yii\helpers\Html;
use yii\web\View;

/* @var View $this */
/* @var MemberShippingAddress[] $addresses */
/* @var PaymentType[] $paymentTypes */
/* @var Book[] $books */
/* @var array $count */
/* @var array $bookPrices */
/* @var double $totalPrice */
/* @var integer $totalWeight */
/* @var boolean $fromCart */


?>


<link rel="stylesheet" type="text/css" href="/themes/default/systemjs/form/style.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>
<link type="text/css" rel="stylesheet" href="/themes/default/css/simple.css">
<div id="widget_sub_navs">
    <ul class="crumbs clearfix mt15 step-4">
        <li>4、订购完成<em></em><i></i></li>
        <li>3、选择支付<em></em><i></i></li>
        <li class="pass">2、确认订单信息<em></em><i></i></li>
        <li class="pass">1、购物车<em></em><i></i></li>
    </ul>
    <!--- Powered by TinyRise ---></div>
<div class="container">
    <div class="order-info">
        <form action="" class="tiny-form" method="post">
            <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
            <div class="clearfix address address-box">
                <h2><b class="fl">选择收货地址：</b>
                    <a class="btn btn-main btn-mini fr" href="/member/address/index" target="_blank">管理地址</a>
                </h2>

                <ul class="address-list clearfix">
                    <?php foreach ($addresses as $address): ?>
                    <li <?php if ($address->is_default): ?>class="selected"<?php endif; ?>>
                        <input type="hidden" class="js-city-id" value="<?= $address->city_id ?>" />
                        <input type="hidden" class="js-district-id" value="<?= $address->district_id ?>" />

                        <a href="javascript:;" data-value="<?= $address->id ?>" class="modify"> 修改地址 </a>
                        <div class="address-info">
                            <input type="radio" name="address_id" value="<?= $address->id ?>" />

                            <label><?= $address->province_name ?>
                                <strong><?= $address->city_name ?></strong>
                                （<?= $address->name ?> 收）
                            </label>
                            <p>
                                <?= $address->district_name ?> <?= $address->detail_address ?> <?= $address->mobile ?>
                            </p>
                        </div>
                        <i class="icon-selected-32 ie6png"></i>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <div><a id="address_other" class="btn btn-main btn-mini" href="javascript:;">使用新地址</a></div>
            </div>
            <h2 class="f14 mt20">支付方式：</h2>
            <div class="clearfix">
                <ul class="payment-list">
                    <?php foreach ($paymentTypes as $index => $paymentType): ?>
                    <li <?php if (!$index): ?>class="selected"<?php endif; ?>>
                        <input type="radio" name="payment_id" <?php if (!$index): ?>checked="checked"<?php endif; ?> value="<?= $paymentType->id ?>" payment_name="balance">
                        <label><b><?= $paymentType->name ?></b> </label>
                        <div><img src="<?= $paymentType->logo ?>" width="160" height="50"></div>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <h2>图书清单：</h2>
            <div class="blank ">
                <table class="table table-line" style="text-align: left;">
                    <tbody>
                    <tr>
                        <th style="width:60px;">图书</th>
                        <th style="width:200px;">名称</th>
                        <th style="width:100px;">单价</th>
                        <th style="width:100px;">库存</th>
                        <th style="width:120px;">数量</th>
                        <th style="width:80px;">小计</th>
                    </tr>
                    <?php foreach ($books as $book): ?>
                    <tr>
                        <td class="text-center">
                            <a href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                                <img src="/<?= $book->thumbnail ?>" width="50" height="50">
                            </a>
                        </td>
                        <td class="text-center">
                            <a href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                                <?= $book->name ?>
                            </a>
                            <input type="hidden" name="count[<?= $book->isbn ?>]" value="<?= $count[$book->isbn] ?>">
                        </td>
                        <td><?= $book->price ?></td>
                        <td><?= $book->stock ?></td>
                        <td><?= $count[$book->isbn] ?></td>
                        <td class="amount red"><?= $bookPrices[$book->isbn] ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <table class="table table-list">
                    <tbody>
                    <tr>
                        <td>
                            <p>订单备注信息：<input type="text" name="remark" style="width:346px;" inform="0"></p>
                        </td>
                        <td width="260" class="tr">购物车图书合计：</td>
                        <td width="140">
                            <div class="mb10 mt10" style=" background: #f0f0f0;">
                                <span class="fr">
                                    <span style="">
                                        <span class="currency-symbol f18">￥</span>
                                        <b class="cart-total red f18" id="js-book-total-price" total="<?= $totalPrice ?>"><?= $totalPrice ?> </b>
                                    </span>
                                </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                        </td>
                        <td class="tr">运费：</td>
                        <td>
                            <p class="fr">+ <b id="js-freight-price" data-weight="700">0.00</b></p>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="box p15 mt5" id="voucher-n" style="display: none">
                <p class="clearfix">提示：一个订单最多能使用一张代金券（<b class="red">注：代金券仅能抵扣图书金额,多出图书的部分忽略不计</b>）。<a
                            id="voucher-cancel" class="fr btn btn-mini ">取消优惠券</a></p>
                <table class="table table-line">
                    <tbody>
                    <tr style="background: #fff5cc;color: #000;height:20px;">
                        <td>名称</td>
                        <td>编号</td>
                        <td>面值</td>
                        <td>需满足金额</td>
                        <td>有效期</td>
                    </tr>
                    </tbody>
                    <tbody class="page-content"></tbody>
                </table>
                <div class="page-nav"><span href="/index.php?con=simple&amp;act=get_voucher&amp;p=1" class="disabled">上一页</span>
                    <span href="/index.php?con=simple&amp;act=get_voucher&amp;p=2" class="disabled">下一页</span> &nbsp;&nbsp;&nbsp;&nbsp;共0
                    页&nbsp;&nbsp;&nbsp;&nbsp;跳到第 <input style="width:24px;text-align:center" value="1"
                                                        onchange="$(this).next().attr(&quot;page-index&quot;,this.value)">
                    页 <a href="javascript:;" page-index="1">确定</a></div>
            </div>

            <div class="mb10 mt10 clearfix" style="padding:10px; background: #f0f0f0;">
                <span class="fr f14">
                    应付总额：<span style="font-size: 24px;font-family: tahoma;">
                        <span class="currency-symbol">￥</span>
                        <b class="cart-total red" id="js-total-price"><?= $totalPrice ?></b>
                    </span>
                </span>
            </div>
            <div class="blank line fr">
                <?php if ($fromCart): ?>
                <?php foreach ($books as $book): ?>
                <input name="cartIsbn[]" type="hidden" value="<?= $book->isbn ?>" />
                <?php endforeach; ?>
                <?php endif; ?>
                <p class=""><input type="submit" class="btn btn-main" value="提交订单"></p>
            </div>
        </form>
    </div>
</div>
<script type="text/javascript">
    $("#address_other").on("click", function () {
        layer.open({
            type: 2,
            title: '添加收货地址',
            shadeClose: true,
            shade: 0.8,
            maxmin: true,
            area: ['960px', '480px'],
            content: '/member/address/create',
            cancel: function (index, layero) {
                parent.location.reload();
            }
        });
        return false;
    });

    $(".address-list .modify").each(function () {
        $(this).on("click", function () {
            var id = $(this).attr("data-value");
            layer.open({
                type: 2,
                title: '修改收货地址',
                shadeClose: true,
                shade: 0.8,
                maxmin: true,
                area: ['960px', '480px'],
                content: '/member/address/update?id=' + id,
                cancel: function (index, layero) {
                    parent.location.reload();
                }
            });
            return false;
        });
    });
    // $("#voucher-n").Paging({
    //     url: '/index.php?con=simple&act=get_voucher',
    //     params: {amount: 3999},
    //     callback: function () {
    //         calculate();
    //         $("#voucher-n input[name='voucher']").each(function () {
    //             $(this).on("click", function () {
    //                 calculate();
    //             });
    //         });
    //     }
    // });

    $("#voucher-cancel").on("click", function () {
        if ($("#voucher-n input[name='voucher']:checked").size() > 0) {
            $("#voucher-n input[name='voucher']:checked").prop("checked", false);
            calculate();
        }
    })
    $("#voucher-select").on("click", function () {
        $("#voucher-n").toggle();
    })

    $(".address-list li").each(function () {
        $(this).has("input[name='address_id']:checked").addClass("selected");
        $(this).on("click", function () {
            // if (!check_received_areas($(this).find("input").attr("city"), "")) {
            //     layer.alert('此地区不支持货到付款方式。');
            //     return;
            // }
            $(".address-list li").removeClass("selected");
            $("input[name='address_id']").removeProp("checked");
            $("input[name='address_id']", this).prop("checked", true);
            $(this).addClass("selected");
            $("a.default").hide();
            $("a.default", this).show();
            var id = $("input[name='address_id']", this).val();
            var weight = $("#fare").attr("data-weight");
            var allvirtual = "false";

            var requestParam = {
                weight: <?= $totalWeight ?>,
                cId: $(this).find('.js-city-id').val(),
                dId: $(this).find('.js-district-id').val()
            };

            $.get("/freight-template/calc", requestParam, function (data) {
                $('#js-freight-price').text(data.value);
                $('#js-total-price').text(
                    parseFloat($('#js-book-total-price').text()) +
                    parseFloat($('#js-freight-price').text())
                );
            }, 'json');
        });
    });
    // 初始化计算运费
    $('.address-list>li.selected').click();

    // FireEvent($(".address-list  input[name='address_id']:checked").get(0), "click");

    $(".payment-list li").each(function () {
        $(this).has("input[name='payment_id']:checked").addClass("selected");
        $(this).on("click", function () {
            if (!check_received_areas("", $(this).find("input").attr("payment_name"))) {
                layer.alert('此地区不支持货到付款方式。');
                return;
            }
            $(".payment-list li").removeClass("selected");
            $("input[name='payment_id']").removeProp("checked");
            $("input[name='payment_id']", this).prop("checked", true);
            $(this).addClass("selected");
        });
    });

    $("#prom_order").on("change", function () {
        calculate();
    });
    $("#is_invoice").on("click", function () {
        if (!!$(this).prop("checked")) {
            $("#invoice").show();
        } else $("#invoice").hide();
        calculate();
    })

    //计算实付金额
    function calculate() {
        var total = parseFloat($("#js-total-price").attr("total"));
        var voucher = 0;
        var fare = parseFloat($("#fare").text());
        if ($("#voucher-n input[name='voucher']:checked").size() > 0) {
            voucher = parseFloat($("#voucher-n input[name='voucher']:checked").attr('data-value'));
            if (voucher == undefined) voucher = 0;
        }
        total -= voucher;
        $("#voucher").text(voucher.toFixed(2));
        if (total <= 0) total = 0;

        if ($("#is_invoice").size() > 0) {
            if (!!$("#is_invoice").prop("checked")) {
                var tax_fee = ((total * 6) / 100);
                total += tax_fee;
                $("#taxes").text(tax_fee.toFixed(2));
            } else {
                $("#taxes").text("0.00");
            }
        }

        total += fare;
        if ($("#prom_order").size() > 0) {
            var prom_order = $("#prom_order").find("option:selected");
            var type = prom_order.attr("data-type");
            var value = parseFloat(prom_order.attr("data-value"));
            var data_point = parseInt($("#point").attr("data-point"));

            $("#point").text(data_point);
            if (type != 4) {

                if (type == 2) {
                    data_point = data_point * value;
                    $("#point").text(data_point);
                    $("#prom_order_text").text('0.00');
                } else {
                    total = (total - value);
                    $("#prom_order_text").text(value.toFixed(2));
                }

            } else {
                total = (total - value - fare);
                $("#prom_order_text").text(fare.toFixed(2));
            }
        }
        if (total < 0) total = 0;
        $("#real-total").text(total.toFixed(2));
    }

    calculate();
    var form = new Form();
    form.setValue('address_id', "0");
    form.setValue('payment_id', "1");
    form.setValue('user_remark', "");
    form.setValue('prom_id', "");

    function check_received_areas(city, payment_name) {
        if (city == "") city = $("input[name='address_id']:checked").attr("city");
        if (payment_name == "") payment_name = $("input[name='payment_id']:checked").attr("payment_name");
        var received_areas = "";
        var areas = received_areas.split(",");
        var flag = false;
        if (payment_name == "received") {
            for (i in areas) {
                if (areas[i] == city) flag = true;
            }
        } else {
            flag = true;
        }
        return flag;
    }
</script>

