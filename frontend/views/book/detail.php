<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model Book */
/* @var $brand Brand */
/* @var $cateAncestors Category[] */
/* @var $sameCategoryBooks Book[] */
/* @var $bookAuthors BookAuthor[] */
/* @var OrderAppraise[] $appraises */
/* @var Pagination $pagination */
/* @var integer $appraiseCount */
/* @var double $appraiseScoreSum */
/* @var integer $appraiseGreatScoreCount */
/* @var integer $appraiseMiddleScoreCount */
/* @var integer $appraiseGeneralScoreCount */

use common\models\goods\Book;
use common\models\goods\BookAuthor;
use common\models\goods\Category;
use common\models\goods\Brand;
use common\models\MemberAccountRecord;
use common\models\order\OrderAppraise;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use frontend\widgets\LinkPager;

?>


<link rel="stylesheet" type="text/css" href="/themes/default/systemjs/form/style.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>
<link type="text/css" rel="stylesheet" href="/themes/default/css/product.css">
<script src="/themes/default/vendors/raphael-min.js" type="text/javascript"></script>
<script src="/themes/default/vendors/jquery.ratemate.js" type="text/javascript"></script>

<!-- S 面包屑 -->
<div class="bread-crumb">
    <ol class="container">
        <?php foreach ($cateAncestors as $index => $cateAncestor): ?>
            <li><a class="category-<?= $index ?>"
                   href="/index.php?con=index&amp;act=category&amp;cid=1"><?= $cateAncestor->name ?></a></li>
        <?php endforeach; ?>
    </ol>
</div>

<!-- E 面包屑 -->

<div class="container">
    <!--S 产品展示-->
    <div id="product-intro">

        <div class="sub-1" id="gallery">
            <div style="position: absolute;height:800px;">
                <a class="small-img" href="javascript:;">
                    <img src="/<?= $model->thumbnail ?>" source="/<?= $model->thumbnail ?>" width="60">
                </a>

                <?php if ($model->show_pictures && is_array($model->show_pictures)): ?>
                <?php foreach ($model->show_pictures as $picture): ?>
                    <a class="small-img" href="javascript:;">
                        <img src="/<?= $picture ?>" source="/<?= $picture ?>" width="60">
                    </a>
                <?php endforeach; ?>
                <?php endif ?>
            </div>
        </div>
        <div class="sub-2">
            <div id="preview">
                <div id="imgmini" style="width: 420px;height:420px;">
                    <img class="big-pic" width="360" height="420px;" src="/<?= $model->thumbnail ?>"
                         source="/<?= $model->thumbnail ?>"/>
                </div>
            </div>
        </div>

        <div class="sub-3">
            <ul class="product-info">
                <li class="product-title"><?= $model->name ?></li>
                <li class="product-no">
                    <label>ISBN号：</label><span id="pro-no"><?= $model->isbn ?></span></li>
                <li class="red">
                </li>
                <li class="product-price"><span id="sell_price" class="price"><?= $model->price ?>元</span></li>
            </ul>

            <fieldset class="line-title">
                <legend align="center" class="txt">图书信息</legend>
            </fieldset>

            <div class="spec-info">
                <div class="spec-close"></div>
                <form action="/order/create" method="post">
                    <?= Html::hiddenInput(Yii::$app->request->csrfParam, Yii::$app->request->csrfToken) ?>
                    <?= Html::hiddenInput('isbn', $model->isbn) ?>

                    <dl class="spec-item ">
                        <dt>购买量</dt>
                        <dd class="buy-num" id="buy-num-bar">
                            <a href="javascript:;"><i class="icon-minus-16"></i></a>
                            <input id="buy-num" name="count" value="1" maxlength="5">
                            <a href="javascript:;">
                                <i class="icon-plus-16"></i>
                            </a>&nbsp;&nbsp;&nbsp;&nbsp;
                            <span class="vm">库存：<b id="store_nums" class="red"><?= $model->stock ?></b></span>
                        </dd>
                    </dl>
                    <dl id="spec-msg" class="spec-item " style="display: none;">
                        <dt></dt>
                        <dd>
                            <p class="msg"><i class="icon icon-alert-16"></i><span>请选择您要购买的商品规格</span></p>
                        </dd>
                    </dl>
                    <dl class="spec-item ">
                        <dd class="product-btns" id="product-buttons">
                            <button type="submit" class="btn btn-warning">
                                <i class="icon-basket-32 ie6png"></i>
                                <span>立即购买</span>
                            </button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="javascript:;" class="js-cart-create btn btn-main">
                                <i class="icon-cart-1-32 ie6png"></i>
                                <span>加入购物车</span>
                            </a>&nbsp;&nbsp;&nbsp;&nbsp;
                        </dd>
                    </dl>
                </form>
            </div>
        </div>
    </div>
    <!--S 商品详情-->
    <div>
        <!--S 捆绑销售 -->
    </div>
    <div class="product-main">
        <div class="sub-1">
            <fieldset class="line-title">
                <legend align="center" class="txt">同类图书推荐</legend>
            </fieldset>

            <ul class="list">
                <?php foreach ($sameCategoryBooks as $sameCategoryBook): ?>
                    <li class="item">
                        <div class="header">
                            <a href="detail?isbn=<?= $sameCategoryBook->isbn ?>" target="_blank">
                                <img src="/<?= $sameCategoryBook->thumbnail ?>" width="200">
                            </a>
                        </div>
                        <ul class="main">
                            <li><a href="detail?isbn=<?= $sameCategoryBook->isbn ?>"
                                   target="_blank"><?= $sameCategoryBook->name ?></a></li>
                            <li><span class="price">售价：<b class="red"><?= $sameCategoryBook->price ?></b></span></li>
                        </ul>
                    </li>
                <?php endforeach; ?>

            </ul>
        </div>
        <div class="sub-2">
            <div class="goods-detail">
                <div class="content">
                    <!--S 捆绑销售 -->

                    <div class="tab " index="0">
                        <ul class="tab-head">
                            <li class="current">商品详情<i></i></li>
                            <li>商品评价<i></i></li>
                            <li>权利声明<i></i></li>
                        </ul>
                        <div class="tab-body" style="min-height: 200px;">
                            <!--S 商品详情-->
                            <div class=" " style="display: block;">
                                <div class="list">
                                    <ul class="row-4">
                                        <li class="col-1">出版社：<?= $brand->name ?></li>
                                        <li class="col-1">
                                            作者：
                                            <?php foreach ($bookAuthors as $bookAuthor): ?>
                                            <?= $bookAuthor->getAuthor()->one()->name ?> /
                                            <?php endforeach; ?>
                                        </li>
                                        <li class="col-1">出版日期：<?= $model->publish_date ?></li>
                                        <li class="col-1">页数：<?= $model->pages ?></li>
                                        <li class="col-1">译者：<?= $model->translator ?></li>
                                        <li class="col-1">装帧：<?= $model->binding ?></li>
                                    </ul>
                                </div>
                                <div class="description  ">
                                    <p>
                                    </p>
                                    <p>
                                        <br>
                                    </p>
                                    <div>
                                        <p>
                                            <?= $model->introduce ?>
                                        </p>
                                    </div>
                                    <p>
                                    </p></div>
                            </div>
                            <!--E 商品详情-->
                            <!--S 商品评价-->
                            <div class="comment-list" style="display: none;">
                                <div class="comment-top ">
                                    <ul>
                                        <li>
                                            <div class="comment-score">
                                                <em class="circle ">
                                                    <?php if ($appraiseCount): ?>
                                                    <?= $appraiseScoreSum / $appraiseCount * 20 ?>
                                                    <?php else: ?>
                                                    0
                                                    <?php endif; ?>
                                                    <i style="font-size: 18px;">%</i>
                                                </em>- 好评度 -
                                            </div>
                                            <div class="mt10 score ie6png"><i style="width:0%"></i></div>
                                        </li>
                                        <li class="comment-grade">
                                            <div>
                                                <h1>共有(<?= $appraiseCount ?>)人参考评价</h1>
                                                <dl class="comment-percent">
                                                    <dt>很好</dt>
                                                    <?php if ($appraiseCount): ?>
                                                    <dd class="bar"><i style="width:<?= sprintf('%.2f', $appraiseGreatScoreCount / $appraiseCount) * 100 ?>%"></i></dd>
                                                    <dd class="percent"><?= sprintf('%.2f', $appraiseGreatScoreCount / $appraiseCount) * 100 ?>%</dd>
                                                    <?php else: ?>
                                                    <dd class="bar"><i style="width:0%"></i></dd>
                                                    <dd class="percent">0%</dd>
                                                    <?php endif; ?>

                                                    <dt>较好</dt>
                                                    <?php if ($appraiseCount): ?>
                                                    <dd class="bar"><i style="width:<?= sprintf('%.2f', $appraiseMiddleScoreCount / $appraiseCount) * 100 ?>%"></i></dd>
                                                    <dd class="percent"><?= sprintf('%.2f', $appraiseMiddleScoreCount / $appraiseCount) * 100 ?>%</dd>
                                                    <?php else: ?>
                                                    <dd class="bar"><i style="width:0%"></i></dd>
                                                    <dd class="percent">0%</dd>
                                                    <?php endif; ?>

                                                    <dt>一般</dt>
                                                    <?php if ($appraiseCount): ?>
                                                    <dd class="bar"><i style="width:<?= sprintf('%.2f', $appraiseGeneralScoreCount / $appraiseCount) * 100 ?>%"></i></dd>
                                                    <dd class="percent"><?= sprintf('%.2f', $appraiseGeneralScoreCount / $appraiseCount) * 100 ?>%</dd>
                                                    <?php else: ?>
                                                    <dd class="bar"><i style="width:0%"></i></dd>
                                                    <dd class="percent">0%</dd>
                                                    <?php endif; ?>
                                                </dl>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="comment tab" id="comment" index="0">
                                    <ul class="tab-head">
                                        <li class="current">全部(<?= $appraiseCount ?>)<i></i></li>
                                    </ul>
                                    <div class="tab-body">
                                        <div id="comment-all" class="" style="display: block;">
                                            <div class="page-content">
                                                <div class="comment-item">

                                                    <?php foreach ($appraises as $appraise): ?>
                                                    <div class="consult-q">
                                                        <div class="comment-content" style="margin-left: 0px;">
                                                            <p class="top">
                                                                <span class="score">
                                                                    <i style="width:80%"></i>
                                                                </span>
                                                                <span class="fr"><?= $appraise->create_time ?></span>
                                                            </p>
                                                            <p>
                                                                <input id="js-rate-input-<?= $appraise->id ?>" max="5" min="0" step="1" style="display:none" type="number" value="<?= $appraise->score ?>">
                                                            </p>
                                                            <p><?= $appraise->content ?></p>
                                                        </div>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>


                                            <?php echo LinkPager::widget([
                                                'pagination' => $pagination,
                                                'nextPageLabel' => '下一页',
                                                'prevPageLabel' => '上一页',
                                                'options' => ['class' => 'page-nav'],
                                            ]); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--E 商品评价-->

                            <!--S 售后保障-->
                            <div class="" style="display: none;">
                                <div>
                                    <div style="color:#666666;font-family:Arial;">
                                        书店所有商品信息、客户评价、商品咨询、网友讨论等内容，是书店重要的经营资源，未经许可，禁止非法转载使用。
                                        <p>
                                            <b>注：</b>本站图书信息均来自于厂商，其真实性、准确性和合法性由信息拥有者（厂商）负责。本站不提供任何保证，并不承担任何法律责任。
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--E 售后保障-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--E 商品详情-->

    <!-- S 悬停快速购物 -->
    <div class="goods-top-fixed-bar hidden">
        <div id="fixed-wrap">
            <div class="container">
                <div class="list">
                    <div class="row-4">
                        <div class="col-1"><a href="javascript:;" class="attention btn btn-info"><i
                                        class="icon-hart-32 ie6png"></i><span>关注</span></a></div>
                        <div class="col-1 selected-spec"><span id="goods-selected-spec">&nbsp;</span></div>
                        <div class="col-1 tr goods-count">
                            <span>合计：</span><span id="selected-price">4898.00元</span>
                        </div>
                        <div class="col-1 " style="text-align:right">
                            <button type="submit" class="buy-now btn btn-warning">
                                <i class="icon-basket-32 ie6png"></i>
                                <span>立即购买</span>
                            </button>
                            <a href="javascript:;" class="js-cart-create btn btn-main">
                                <i class="icon-cart-1-32 ie6png"></i><span>加入购物车</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- E 悬停快速购物 -->
    <div id="notify-dialog" style="display:none;padding:10px 20px;">
        <form id="notify_form" method="post" class="tiny-form" callback="submit_notify" novalidate="true">
            <ul>
                <li class="line"><h1>订阅到货通知：</h1></li>
                <li class="line caption">
                    <label class="caption">邮箱地址：</label><input type="text" class="field" id="n_email" name="email"
                                                               pattern="email" inform="2">
                </li>
                <li class="line caption">
                    <label class="caption">手机号码：</label><input type="text" class="field" id="n_mobile" empty=""
                                                               name="mobile" pattern="mobi" inform="2">
                </li>
                <li class="line">
                    <input type="submit" class="btn" value="到货通知">
                </li>
            </ul>
        </form>
    </div>
</div>
<script type="text/javascript">

    $(window).scroll(function () {
        var a = $('.goods-top-fixed-bar');
        var top = $(".goods-detail").offset().top;
        var e = $(window).scrollTop();
        e >= top ? (a.addClass("fixed"), setTimeout(function () {
            a.addClass("show")
        }, 100)) : (a.removeClass("fixed"), a.removeClass("show"));
    });

    function changeImg(id) {
        id.find("img").each(function () {
            $(this).attr("src", $(this).attr("src-data"));
            $(this).removeAttr("src-data");
        });
    }

    $(function () {
        <?php foreach ($appraises as $appraise): ?>
        $('#js-rate-input-<?= $appraise->id ?>').ratemate({
            width: 150,
            height: 30
        });
        <?php endforeach; ?>
    });

    // $("#goods-consult").Paging({
    //     url: '/index.php?con=index&act=get_ask',
    //     callback: changeImg,
    //     params: {
    //         id: 6
    //     }
    // });
    // $("#comment-all").Paging({
    //     url: '/index.php?con=index&act=get_review',
    //     callback: changeImg,
    //     params: {
    //         id: 6
    //     }
    // });
    // $("#comment-a").Paging({
    //     url: '/index.php?con=index&act=get_review',
    //     callback: changeImg,
    //     params: {
    //         id: 6,
    //         score: 'a'
    //     }
    // });
    // $("#comment-b").Paging({
    //     url: '/index.php?con=index&act=get_review',
    //     callback: changeImg,
    //     params: {
    //         id: 6,
    //         score: 'b'
    //     }
    // });
    // $("#comment-c").Paging({
    //     url: '/index.php?con=index&act=get_review',
    //     callback: changeImg,
    //     params: {
    //         id: 6,
    //         score: 'c'
    //     }
    // });

    $("#consult").on("click", function () {

        var content = $("#consult-content").val();
        var verifyCode = $("#verifyCode").val();
        if (!Tiny.user.online) {
            loginMin();
        } else if (content == '') {
            layer.msg("内容不能为空！");
        } else if (verifyCode == '') {
            layer.msg("验证码不能为空！");
        } else {
            $.post("/index.php?con=index&act=goods_consult", {
                id: 6,
                content: content,
                verifyCode: verifyCode
            }, function (data) {
                if (data['status'] == 'success') {
                    $("#goods-consult").Paging({
                        url: '/index.php?con=index&act=get_ask',
                        params: {
                            id: 6
                        }
                    });
                    $("#consult-content").val('');
                    $("#verifyCode").val('');
                    FireEvent(document.getElementById('change-img'), "click");
                    layer.msg("<p class='success'>发布成功!</p>");
                } else {
                    layer.msg("<p class='fail'>" + data['msg'] + "</p>");
                }
            }, 'json')
        }

        return false;
    })

    $("#imgmini").enlarge({
        // 鼠标遮罩层样式
        shadecolor: "#FFF",
        shadeborder: "#FF8000",
        shadeopacity: 0.5,
        cursor: "move",

        // 大图外层样式
        layerwidth: 420,
        layerheight: 420,
        layerborder: "#FFF",
        fade: true
    });
    var skuMap = {
        ";1:3;2:8;": {
            "sell_price": "4898.00",
            "market_price": "5000.00",
            "store_nums": "12",
            "specs_key": ";1:3;2:8;",
            "pro_no": "AG0012320_3",
            "id": "18"
        },
        ";1:3;2:5;": {
            "sell_price": "4898.00",
            "market_price": "5000.00",
            "store_nums": "12",
            "specs_key": ";1:3;2:5;",
            "pro_no": "AG0012320_2",
            "id": "17"
        },
        ";1:3;2:7;": {
            "sell_price": "4898.00",
            "market_price": "5000.00",
            "store_nums": "12",
            "specs_key": ";1:3;2:7;",
            "pro_no": "AG0012320_1",
            "id": "16"
        }
    };
    //更新库存信息
    var store_nums = <?= $model->stock ?>;
    // for (i in skuMap) {
    //     store_nums += parseInt(skuMap[i]['store_nums']);
    // }
    // $("#store_nums").text(store_nums);
    // $("#goods_nums").text(store_nums);

    $("#gallery  .small-img").each(function (i) {
        if (i == 0) $(this).addClass("current");
        $(this).on("mouseenter", function () {
            $(this).parent().find("a").removeClass("current");
            $(this).addClass("current");
            $("#imgmini img").attr("src", $(this).find("img").attr("src"));
            $("#imgmini img").attr("source", $(this).find("img").attr("source"));
        })
    });
    $(".spec-values li").each(function () {
        $(this).on("click", function () {
            var disabled = $(this).hasClass('disabled');
            if (disabled) return;
            var flage = $(this).hasClass('selected');

            $(this).parent().find("li").removeClass("selected");
            if (!flage) {
                $(this).addClass("selected");
            }
            changeStatus();
            var selected_spec = new Array();
            $('.spec-values li.selected').each(function () {
                selected_spec.push($(this).text());
            });
            $('#goods-selected-spec').text(selected_spec.join(' , '));
            if ($(".spec-values").length == $(".spec-values .selected").length) {
                var sku = new Array();
                $(".spec-values .selected").each(function (i) {
                    sku[i] = $(this).attr("data-value");
                })
                var sku_key = ";" + sku.join(";") + ";";
                if (skuMap[sku_key] != undefined) {
                    var sku = skuMap[sku_key];
                    $("#sell_price").text(sku['sell_price'] + "元");
                    $("#store_nums").text(sku['store_nums']);
                    $("#goods_nums").text(sku['store_nums']);
                    if ($("#prom_price").size() > 0) {
                        var formula = $("#prom_price").attr('formula');
                        var prom_price = eval(sku['sell_price'] + formula);
                        if (prom_price <= 0) prom_price = 0;
                        $("#prom_price").text(prom_price.toFixed(2) + " 元");
                        $("#selected-price").text(prom_price.toFixed(2) + " 元");
                    }


                    $("#market-price").text(sku['market_price']);

                    $("#pro-no").text(sku['pro_no']);
                }
                $("#spec-msg").css("display", "none");
                specClose();
            } else {
                $("#store_nums").text("<?= $model->stock ?>");
            }
        })
    })

    function changeStatus() {
        var specs_array = new Array();
        $(".spec-values").each(function (i) {
            var selected = $(this).find(".selected");
            if (selected.length > 0) specs_array[i] = selected.attr("data-value");
            else specs_array[i] = "\\\d+:\\\d+";

        });
        $(".spec-values").each(function (i) {
            var selected = $(this).find(".selected");
            $(this).find("li").removeClass("disabled");
            var k = i;
            $(this).find("li").each(function () {

                var temp = specs_array.slice();
                temp[k] = $(this).attr('data-value');
                var flage = false;
                for (sku in skuMap) {
                    var reg = new RegExp(';' + temp.join(";") + ';');
                    if (reg.test(sku) && skuMap[sku]['store_nums'] > 0) flage = true;


                }
                if (!flage) $(this).addClass("disabled");
            })

        });
    }

    $("#buy-num-bar a:eq(0)").on("click", function () {
        var num = $("#buy-num-bar input").val();
        if (num > 1) num--;
        else num = 1;
        $("#buy-num-bar input").val(num);
        btnNumStatus(num);
    });
    $("#buy-num-bar a:eq(1)").on("click", function () {
        var num = $("#buy-num-bar input").val();
        var max = parseInt($("#store_nums").text());
        if (num < max) num++;
        else num = max;
        $("#buy-num-bar input").val(num);
        btnNumStatus(num);
    });
    $("#buy-num-bar input").on("change", function () {
        var value = $(this).val();
        var max = parseInt($("#store_nums").text());
        if ((/^\d+$/i).test(value)) {
            value = Math.abs(parseInt(value));
            if (value < 1) value = 1;
            if (value > max) value = max;
        } else {
            value = 1;
        }
        $(this).val(value);
        btnNumStatus(value);
    })

    function btnNumStatus(value) {
        var max = parseInt($("#store_nums").text());
        if (value <= 1) {
            $("#buy-num-bar a:eq(0)").addClass('disable');
        } else {
            $("#buy-num-bar a:eq(0)").removeClass('disable');
        }
        if (value >= max) {
            $("#buy-num-bar a:eq(1)").addClass('disable');
        } else {
            $("#buy-num-bar a:eq(1)").removeClass('disable');
        }
    }

    //立即购买
    $(".buy-now").on("click", function () {
        var product = currentProduct();
        if (product) {
            var id = product["id"];
            var num = parseInt($("#buy-num").val());
            var max = parseInt($("#store_nums").text());
            if (num > max) {
                $("#spec-msg").css("display", "");
                showMsgBar('stop', "购买商品数量，超出了允许购买的最大量！");
                return false;
            } else if (max <= 0) {
                $("#spec-msg").css("display", "");
                showMsgBar('stop', "库存不足！");
                return false;
            } else {
                $("#spec-msg").css("display", "none");
            }
            var url = "/index.php?con=index&act=goods_add&id=__id__&num=__num__";
            url = url.replace("__id__", id);
            url = url.replace("__num__", num);
            window.location.href = url;
        } else {
            $("#spec-msg").css("display", "");
            showMsgBar('alert', "请选择您要购买的商品规格！");
            $(window).scrollTop(0);
        }
    });

    //添加到购物车
    $(".js-cart-create").on("click", function () {
        var request = {
            isbn: '<?= $model->isbn ?>',
            count: $('input[name="count"]').val(),
            <?= Yii::$app->request->csrfParam ?>: '<?= Yii::$app->request->csrfToken ?>'
        };

        $.post("/cart/create", request, function (response) {
            layer.msg("<p class='success'>" + response.msg + "</p>");
            if (response.code !== 200) {
                return ;
            }

            var tmp = $($("#imgmini img").get(0).cloneNode(true));
            tmp.css({
                position: 'absolute',
                'z-index': '9998',
                border: 'solid 1px #ccc',
                background: '#aaf',
                'overflow': 'hidden',
                background: '#fff'
            });
            var imgView = $("#imgmini").offset();
            tmp.css(imgView);
            tmp.appendTo($('body'));
            var end = $(".shopping").offset();
            var step1 = {
                top: end.top + 160,
                left: end.left + 30,
                width: 100,
                height: 100,
                opacity: 0.8
            };
            var step2 = {
                top: end.top,
                left: end.left + 30,
                width: 100,
                height: 100,
                opacity: 0
            };

            $(tmp).animate(step1, "slow").animate(step2, "slow", function () {
                tmp.remove();
            });
        }, "json");
    });
    //关闭信息提示
    $(".spec-close").on("click", function () {
        specClose();
    });

    function specClose() {
        $(".spec-info").removeClass("noselected");
    }

    //取得当前商品
    function currentProduct() {
        if ($(".spec-values").length == 0) {
            return skuMap[''];
        }
        if ($(".spec-values").length == $(".spec-values .selected").not(".disabled").length) {
            var sku = new Array();
            $(".spec-values .selected").each(function (i) {
                sku[i] = $(this).attr("data-value");
            })
            var sku_key = ";" + sku.join(";") + ";";
            if (skuMap[sku_key] != undefined) {
                return skuMap[sku_key];
            } else return null;
        } else return null;
    }

    //展示信息
    function showMsgBar(type, text) {
        $(".spec-info").addClass("noselected");
        $(".msg").find("span").text(text);
        $(".msg").find("i").attr("class", "icon icon-" + type + "-16");
    }

    //切换画廊图片
    $(".turn-right,.turn-left").on("click", function () {
        var canvas = $(".show-list >div");
        var num = canvas.find("a").size();
        var flage = -1;
        var current = 0;
        var width = 66;
        var show_num = 5;
        var left = 0;
        current = Math.round((Math.abs(canvas.position().left) / width));
        if ($(this).hasClass("turn-left")) {
            current--;
        } else {
            current++;
        }
        if (num - current >= show_num && current >= 0) {
            left = current * flage * width;
            canvas.animate({
                left: left
            }, 200);
        }
    })

    $(".attention").on("click", function () {
        $.post("/index.php?con=index&act=attention", {
            goods_id: 6
        }, function (data) {
            if (data['status'] == 2) layer.msg("<p class='warning'>已关注过了该商品！</p>");
            else if (data['status'] == 1) layer.msg("<p class='success'>成功关注了该商品!</p>");
            else {
                loginMin();
            }
        }, 'json')
    })
    //到货通知
    $("#goods-notify").on("click", function () {
        if (Tiny.user.online) {
            layer.open({
                type: 1,
                area: ['520px', '300px'], //宽高
                content: $('#notify-dialog')
            });
        } else {
            loginMin();
        }

    })

    function submit_notify(e) {
        if (e == null) {
            var email = $("#n_email").val();
            var mobile = $("#n_mobile").val();
            $.post("/index.php?con=index&act=notify", {
                goods_id: 6,
                email: email,
                mobile: mobile
            }, function (data) {
                if (data['status'] != undefined) {
                    layer.closeAll();
                    layer.msg('<p class="' + data['status'] + '">' + data['msg'] + '</p>');
                }
            }, 'json');
            return false;
        }
        return false;
    }
</script>
<!--E 产品展示-->

