<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

use common\models\goods\Book;
use yii\helpers\Html;
use yii\web\View;

/* @var View $this */
/* @var integer $count */
/* @var Book $book */
/* @var double $totalPrice */

?>

<link type="text/css" rel="stylesheet" href="/themes/default/css/simple.css">
<div id="widget_sub_navs">
    <ul class="crumbs clearfix mt15 step-4">
        <li>4、订购完成<em></em><i></i></li>
        <li>3、选择支付<em></em><i></i></li>
        <li>2、确认订单信息<em></em><i></i></li>
        <li class="pass">1、购物车<em></em><i></i></li>
    </ul>
    <!--- Powered by TinyRise --->
</div>

<form action="confirm" method="post">
    <div class="container blank">
        <div class="blank clearfix"></div>
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
            <tr class="even" id="46">
                <td>
                    <a href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                        <img src="/<?= $book->thumbnail ?>" width="50" height="50">
                    </a>
                </td>
                <td>
                    <a href="/book/detail?isbn=<?= $book->isbn ?>" target="_blank">
                        <?= $book->name ?>
                    </a>
                </td>
                <td><?= $book->price ?></td>
                <td><?= $book->stock ?></td>
                <td>
                    <div class="buy-num-bar buy-num clearfix">
                        <a class="js-count-reduce-btn" href="javascript:;" data-min="1"><i class="icon-minus-16"></i></a>
                        <input name="count[<?= $book->isbn ?>]" value="<?= $count ?>" maxlength="5">
                        <a class="js-count-add-btn" href="javascript:;" data-max="<?= $book->stock ?>"><i class="icon-plus-16"></i></a>
                    </div>
                </td>
                <td class="amount red" id="js-price-count2"><?= $totalPrice ?></td>
            </tr>
            </tbody>
        </table>
        <div class="blank clearfix" style="padding:10px; background: #f0f0f0;">
            <span class="fr">图书总价(不含运费)：
                <span style="font-size: 24px;font-family: tahoma;">
                    <span class="currency-symbol">￥</span>
                    <b class="red" id="js-price-count" data-price="<?= $book->price ?>"><?= $totalPrice ?></b>
                </span>
            </span>
        </div>
        <div class="mt10 clearfix">
            <p class="fr">
                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                <a class="btn btn-gray" href="javascript:;" onclick="window.history.back()">返回</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn btn-main">立即结算</button>
            </p>
        </div>
    </div>
</form>

<script type="text/javascript">
    $('.js-count-add-btn').on('click', function() {
        var input = $('input[name="count[<?= $book->isbn ?>]"]');
        var value = input.val();
        if (value < $(this).data('max')) {
            input.val(++value);
            var priceDom = $('#js-price-count');
            var price = (parseInt(value) * parseFloat(priceDom.data('price'))).toFixed(2);
            priceDom.text(price);
            $('#js-price-count2').text(price);
        }
    });

    $('.js-count-reduce-btn').on('click', function() {
        var input = $('input[name="count[<?= $book->isbn ?>]"]');
        var value = input.val();
        if (value > $(this).data('min')) {
            input.val(--value);
            var priceDom = $('#js-price-count');
            var price = (parseInt(value) * parseFloat(priceDom.data('price'))).toFixed(2);
            priceDom.text(price);
            $('#js-price-count2').text(price);
        }
    });

    $(".btn-dec").on("click", function () {
        var parent = $(this).parent().parent();
        var id = parent.parent().attr("id");
        var num = parent.find("input").val();
        if (num > 1) num--;
        else num = 1;
        parent.find("input").val(num);
    });
    $(".btn-add").on("click", function () {
        var parent = $(this).parent().parent();
        var id = parent.parent().attr("id");
        var num = parent.find("input").val();
        num++;
        parent.find("input").val(num);
    });

    // $(".buy-num-bar input").on("change", function () {
    //     var num = parseInt($(this).val());
    //     var parent = $(this).parent().parent();
    //     var id = parent.parent().attr("id");
    //     changeInfo(id, num);
    // })
    // $(".icon-close-16").on("click", function () {
    //     var parent = $(this).parent();
    //     var id = $(this).parent().parent().attr("id");
    //     $.post("/index.php?con=index&act=cart_del&cart_type=goods", {id: id}, function (data) {
    //         if (data['status'] == 'success') location.reload();
    //     }, 'json');
    // })

    // function changeInfo(id, num) {
    //     $.post("/index.php?con=index&act=cart_num&cart_type=goods", {id: id, num: num}, function (data) {
    //         var total = 0.00;
    //         for (var i in data) total += parseFloat(data[i]['amount']);
    //         $("#" + id).find(".amount").text(data[id]['amount']);
    //         $("#" + id).find(".goods-prom").text(data[id]['prom']);
    //         if (parseInt($("#" + id).find("input").val()) > data[id]['store_nums']) {
    //             $("#" + id).find("input").val(data[id]['store_nums']);
    //             var parent = $("#" + id).find("input").parent().parent();
    //             if (parent.find(".alert-min").size() == 0) parent.append("<div class='alert alert-fail alert-min'>最多购买" + data[id]['store_nums'] + "件</div>");
    //         } else {
    //             $("#" + id).find("input").val(data[id]['num']);
    //             $("#" + id).find("input").parent().parent().find(".alert-min").remove();
    //         }
    //         $(".cart-total").text(total.toFixed(2));
    //     }, "json");
    // }
</script>

