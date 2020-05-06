<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

use common\models\goods\Book;
use common\models\MemberCart;
use yii\helpers\Html;
use yii\web\View;

/* @var View $this */
/* @var integer $count */
/* @var MemberCart[] $carts */
/* @var Book[] $books */
/* @var array $bookPrices */
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

<div class="container blank" id="js-cart-empty" <?php if ($carts): ?>style="display: none;"<?php endif; ?>>
    <div class="blank clearfix"></div>
    <div class="mt20 mb20 p20 box">
        <p class="cart-empty ie6png">购物车内暂时没有商品，<a href="/">去首页</a> 挑选喜欢的商品。</p>
    </div>
    <div class="mt10 clearfix">
        <p class="fr">
            <a class="btn btn-main" href="/">&lt; 继续购物</a>
        </p>
    </div>
</div>

<form action="/order/confirm" method="post" id="js-cart-list" <?php if (!$carts): ?>style="display: none;"<?php endif; ?>>

    <div class="container blank">
        <div class="blank clearfix"></div>
        <table class="table table-line" style="text-align: left;">
            <tbody>
            <tr>
                <th style="width:60px;">选择</th>
                <th style="width:60px;">图书</th>
                <th style="width:200px;">名称</th>
                <th style="width:100px;">单价</th>
                <th style="width:100px;">库存</th>
                <th style="width:120px;">数量</th>
                <th style="width:80px;">小计</th>
                <th style="width:40px;">操作</th>
            </tr>
            <?php foreach ($books as $index => $book): ?>
            <tr class="even">
                <td>
                    <input type="checkbox" name="isbn[]" checked value="<?= $book->isbn ?>" style="font-size: 100%; display: inline-block; width: 15px; height: 20px; padding-left: 30px;">
                </td>
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
                <td class="js-book-price"><?= $book->price ?></td>
                <td><?= $book->stock ?></td>
                <td>
                    <div class="buy-num-bar buy-num clearfix">
                        <a class="js-count-reduce-btn" href="javascript:;" data-min="1"><i class="icon-minus-16"></i></a>
                        <input name="count[<?= $book->isbn ?>]" data-isbn="<?= $book->isbn ?>" value="<?= $carts[$index]->count ?>" maxlength="5">
                        <a class="js-count-add-btn" href="javascript:;" data-max="<?= $book->stock ?>"><i class="icon-plus-16"></i></a>
                    </div>
                </td>
                <td class="amount red js-book-total-price"><?= $bookPrices[$index] ?></td>
                <td>
                    <a href="javascript:;" class="js-cart-delete-btn icon-close-16" data-isbn="<?= $book->isbn ?>"></a>
                </td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div class="blank clearfix" style="padding:10px; background: #f0f0f0;">
            <span class="fr">图书总价(不含运费)：
                <span style="font-size: 24px;font-family: tahoma;">
                    <span class="currency-symbol">￥</span>
                    <b class="red" id="js-price-count" data-price="<?= $totalPrice ?>"><?= $totalPrice ?></b>
                </span>
            </span>
        </div>
        <div class="mt10 clearfix">
            <p class="fr">
                <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                <a class="btn btn-gray" href="javascript:;" onclick="window.history.back()">返回</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" id="js-cart-pay-btn" class="btn btn-main">立即结算</button>
            </p>
        </div>
    </div>
</form>



<script type="text/javascript">
    function refreshBooksTotalPrice() {
        var price = 0.00;
        $('.js-book-total-price').each(function(index) {
            if ($('input[name="isbn[]"]').eq(index).prop('checked')) {
                price = parseFloat($(this).text()) + price;
            }
        });
        $('#js-price-count').text(price.toFixed(2));
        if (price > 0) {
            $('#js-cart-pay-btn').show();
        } else {
            $('#js-cart-pay-btn').hide();
        }
    }

    function updateCartCount(isbn, count) {
        var request = {
            isbn: isbn,
            count: count,
            <?= Yii::$app->request->csrfParam ?>: '<?= Yii::$app->request->csrfToken ?>'
        };
        $.post('/cart/update', request, function (response) {

        }, 'json');
    }

    $('input[name="isbn[]"]').on('click', function() {
        refreshBooksTotalPrice();
    });

    $('.js-cart-delete-btn').on('click', function() {
        var request = {
            isbn: $(this).data('isbn'),
            <?= Yii::$app->request->csrfParam ?>: '<?= Yii::$app->request->csrfToken ?>'
        };

        var _this = $(this);
        $.post("/cart/delete", request, function (response) {
            layer.msg("<p class='success'>" + response.msg + "</p>");
            _this.parent().parent().remove();
            if ($('input[name="isbn[]"]').length <= 0) {
                $('#js-cart-list').hide();
                $('#js-cart-empty').show();
            }
        }, 'json');
    })

    $('.js-count-add-btn').on('click', function() {
        var input = $(this).prev();
        var value = input.val();

        if (value < $(this).data('max')) {
            input.val(++value);
            var index = $(this).index('.js-count-add-btn');
            var price = parseFloat($('.js-book-price').eq(index).text());
            var totalPrice = (parseInt(value) * price).toFixed(2);
            $('.js-book-total-price').eq(index).text(totalPrice);

            refreshBooksTotalPrice();
            updateCartCount(input.data('isbn'), value);
        }
    });

    $('.js-count-reduce-btn').on('click', function() {
        var input = $(this).next();
        var value = input.val();
        if (value > $(this).data('min')) {
            input.val(--value);
            var index = $(this).index('.js-count-reduce-btn');
            var price = parseFloat($('.js-book-price').eq(index).text());
            var totalPrice = (parseInt(value) * price).toFixed(2);
            $('.js-book-total-price').eq(index).text(totalPrice);

            refreshBooksTotalPrice();
            updateCartCount(input.data('isbn'), value);
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

