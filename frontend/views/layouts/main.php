<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

/* @var $this \yii\web\View */

/* @var $content string */


use common\models\content\ArticleCategory;
use common\models\content\ArticleContentSearch;
use common\models\goods\Brand;
use common\models\goods\Category;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$bookCategories = Category::find()->indexBy('id')->asArray()->all();
$bookCategories = ArrayHelper::toTreeStructure($bookCategories);

$articleCategories = ArticleCategory::find()->where(['parent_id' => 0])->indexBy('id')->asArray()->all();
$articles = ArticleContentSearch::find()->asArray()->select(['id', 'title', 'category_id'])->all();
foreach ($articles as $article) {
    $articleCategories[$article['category_id']]['articles'][] = $article;
}

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Yii::$app->params['siteBaseInfo']['siteName'] ?></title>
    <meta name="keywords" content="<?= Yii::$app->params['siteBaseInfo']['keyword'] ?>">
    <meta name="description" content="<?= Yii::$app->params['siteBaseInfo']['description'] ?>">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="bookmark" href="/favicon.ico"/>
    <link rel="stylesheet" href="/themes/default/css/common.css">
    <link rel="stylesheet" href="/themes/default/vendors/awesome/css/font-awesome.min.css">
    <style type="text/css">
        .js-template {
            display: none !important;
        }
    </style>
    <script type="text/javascript" src="/themes/default/vendors/jquery.min.js"></script>
    <script type="text/javascript" src="/themes/default/js/common.min.js"></script>
    <script type="text/javascript" src="/themes/default/vendors/layer/layer.js"></script>
    <script type="text/javascript">
        var server_url = '/__con__/__act__';
        var Tiny = {user: {name: 'duanbiaowu', id: '2', online: true}};
    </script>
</head>

<body>
<!-- S 页头部分 -->
<div id="header">
    <div class="top-bar">
        <div class="container top-layout">
            <div class="sub-1" style="display: none;">
                <?= Yii::$app->params['siteBaseInfo']['siteName'] ?>
            </div>
            <div class="sub-2">
                <ul class="nav-x">
                    <li class="item dropdown">
                        <a href="javascript:;">会员中心<i class="fa"></i></a>
                        <div class="dropdown-content user-box">
                            <ul class="user-center">
                                <li class="link"><a href="/order/index">我的订单</a></li>
                                <li class="link"><a href="/index.php?con=ucenter&act=review">商品评价</a></li>
                                <li class="link"><a href="/member/address/index">收货地址</a></li>
                                <li class="link"><a href="/member/password/index">账户安全</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="item split"></li>
                    <?php if (Yii::$app->user->isGuest): ?>
                        <li class="item">
                            <a class="normal" href="/site/login">登录</a>
                            /<a class="normal" href="/site/register">注册</a>
                        </li>
                    <?php else: ?>
                        <li class="item">你好, <?= Yii::$app->user->identity->username ?>!<a href="/site/logout"> 安全退出</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="fixed-top-nav">
        <div id="fixed-wrap">
            <div class="container">
                <div class="header-main">
                    <div class="sub-1">
                        <a href="/">
                            <img src="/images/logo.png" style="width: 224px;"/>
                        </a>
                    </div>
                    <div class="sub-3">
                        <div class="shopping" id="shopping-cart">
                            <div id="cart-header"><i class="icon-cart-32"></i>购物车</div>
                            <div class="dropdown">
                                <ul class="cart-list">
                                </ul>
                                <div class="cart-count clearfix">
                                    <div class="fl">
                                        共 <em id="cart-goods-num"></em> 件商品
                                        <span class="cart-total"></span>
                                    </div>
                                    <a href="/cart/settlement" class="btn btn-main fr">去购物车结算</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sub-2">
                        <form id="search-form" class="search-form" action="/index.php?con=" method="get">
                            <input type="hidden" name="con" value="index">
                            <input type="hidden" name="act" value="search"> <input type='hidden' name='tiny_token_'
                                                                                   value='lqd2nvhc0ywy163g20ubwjrewkdgkxbt'/>
                            <input class="search-keyword" id="search-keyword" class="txt-keyword" name="keyword"
                                   value="" type="text">
                            <button class="btn-search ">搜索</button>
                            <p id="tags-list"><a href="#">算法导论</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <ul class="nav">
        <div class="container">
            <li class="category-box">
                <div class="link">
                    <a href="javascript:;">全部图书分类<i class="triangle-b"></i></a>
                </div>
                <ul class="category">
                    <?php foreach ($bookCategories as $bookCategory): ?>
                        <li>
                            <a href="/index.php?con=index&act=category&cid=5">
                                <?= $bookCategory['name'] ?><i class="fa">&#xf105;</i>
                            </a>
                            <div class="category-sub">
                                <ul class="sub">
                                    <?php foreach ($bookCategory['children'] as $value): ?>
                                        <li>
                                            <h5>
                                                <a href="/index.php?con=index&act=category&cid=6">
                                                    <?= $value['name'] ?>
                                                </a>
                                            </h5>
                                            <p>
                                                <?php foreach ($value['children'] as $item): ?>
                                                    <a href="/index.php?con=index&act=category&cid=7">
                                                        <?= $item['name'] ?>
                                                    </a>
                                                <?php endforeach; ?>
                                            </p>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>

            <li class="link"><a href="/">首页</a></li>

        </div>
    </ul>
</div>
<!-- E 页头部分 -->
<!-- S 主体部分 -->
<div id="main">
    <?= $content ?>
</div>
<!-- E 主体部分 -->
<!-- S 页脚部分 -->
<div id="footer">


    <div class="promise">
        <div class="container">
            <dl>
                <dt class="icon-1"></dt>
                <dd>
                    <p class="title">诚信交易</p>
                    <p>所有产品均出正规渠道采购</p>
                </dd>
            </dl>
            <dl>
                <dt class="icon-2"></dt>
                <dd>
                    <p class="title">按地区收费</p>
                    <p>全国各地，不同区域物流标准</p>
                </dd>
            </dl>
            <dl>
                <dt class="icon-3"></dt>
                <dd>
                    <p class="title">极速更新</p>
                    <p>所有商品信息及时更新</p>
                </dd>
            </dl>
            <dl>
                <dt class="icon-4"></dt>
                <dd>
                    <p class="title">7 * 24</p>
                    <p>客服全天响应</p>
                </dd>
            </dl>
            <dl>
                <dt class="icon-5"></dt>
                <dd>
                    <p class="title">真实拍摄</p>
                    <p>100%真实拍摄，杜绝虚假</p>
                </dd>
            </dl>
        </div>
    </div>

    <div class="container">
        <div class="footer-main">
            <?php foreach ($articleCategories as $index => $articleCategory): ?>
                <ul class="sub-<?= $index ?>">
                    <li class="title"><?= $articleCategory['name'] ?></li>
                    <?php foreach ($articleCategory['articles'] as $article): ?>
                        <li><a href="/article-content/view?id=<?= $article['id'] ?>"><?= $article['title'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            <?php endforeach; ?>
        </div>
        <div class="footer-bottom">
            <?= Yii::$app->params['siteBaseInfo']['address'] ?>
            <?= Yii::$app->params['siteBaseInfo']['siteUrl'] ?>
            <?= Yii::$app->params['siteBaseInfo']['siteIcp'] ?>
        </div>
    </div>
</div>
<!-- E 页脚部分 -->


<script type="text/javascript">
    $(".swiper").TinySwiper();

    $(".category li").mouseenter(function () {
        $(this).addClass("hover");
    }).mouseleave(function () {
        $(this).removeClass("hover");
    });

    $(".category-box").mouseenter(function () {
        $(this).addClass("on");
    }).mouseleave(function () {
        $(this).removeClass("on");
    });

    $("#tags-list a").each(function () {
        $(this).on("click", function () {
            $("#search-keyword").val($(this).text());
            $("#search-form").submit();
        })
    });

    var barLink = new Array(),
        current = -1;
    $(".tiny-bar .link").each(function (i) {
        barLink[i] = false;

        $(this).on('click', function () {
            $(".tiny-bar .link").removeClass("on");
            if (!Tiny.user.online) {
                layer.open({
                    id: 'loginDialog',
                    type: 2,
                    title: '您尚未登录',
                    //shadeClose: true,
                    move: false,
                    shade: 0.6,
                    area: ['416px', '470px'],
                    content: '/index.php?con=login&act=loginform' //iframe的url
                });
                return false;
            }

            if (current != i) {
                $(".quick-box").show();
                current = i;
                $(this).addClass("on");
            } else {
                $(".quick-box").hide();
                current = -1;
            }

        });
    })

    function loginMin() {
        layer.open({
            id: 'loginDialog',
            type: 2,
            title: '您尚未登录',
            //shadeClose: true,
            move: false,
            shade: 0.6,
            area: ['416px', '470px'],
            content: '/index.php?con=login&act=loginform'
        });
        return false;
    }


    $(".link a[href='/']").addClass("current");

    function removeCartActive() {
        $("#shopping-cart").removeClass('cart-active');
    }

    var cartSleep = null;
    $("#shopping-cart").mouseenter(function () {
        clearTimeout(cartSleep);
        var currentNode = $(this);
        if (!currentNode.hasClass('cart-active')) {
            currentNode.addClass("cart-active");
            updateCart();
        }
    }).mouseleave(function () {
        cartSleep = setTimeout("removeCartActive()", 2000);
    });

    function updateCart(data) {
        if (data == null) {
            $.get("/cart/index", function (data) {
                if (data) {
                    updateInfo(data);
                }
            }, 'json');
        } else {
            updateInfo(data);
        }
    }

    function updateInfo(data) {
        var card_items = '';
        var total = 0.00;
        var goods_num = 0;
        for (var i in data.books) {
            // var spec = data[i]['spec'];
            // var spec_str = '';
            //
            // for (var k in spec) {
            //     spec_str += '<span class="spec">' + spec[k]['value'][2] + "</span>";
            // }
            // total += parseFloat(data[i]['amount']);
            // goods_num += data[i]['num'];
            card_items +=
                '<li> ' +
                    '<div class="cart-item">' +
                        ' <a class="thumb" href="/book/detail?isbn=' + data.books[i].isbn + '" target="_blank" >' +
                            '<img src="/' + data.books[i].thumbnail + '" width="50" height="50">' +
                        ' </a>' +
                        ' <a class="name" href="/book/detail?isbn=' + data.books[i].isbn + '" target="_blank"> ' +
                            '<span class="title">' + data.books[i].name + '</span>' +

                        '</a> ' +
                        '<span class="price">' + (parseInt(data.books[i].price)) + '元 × ' + data.books[i].count + '</span>' +
                        ' <a class="btn-del fr" data-isbn="' + data.books[i].isbn + '" href="javascript:;">' +
                            '<i class="icon-close-16"></i>' +
                        '</a>' +
                    '</div> ' +
                '</li>';
        }

        if (card_items === '') {
            card_items = '<li> <div style="line-height:80px;text-align:center;">购物车中还没有图书，赶紧选购吧！</div> </li>';
        }
        $(".cart-list").html(card_items);
        $(".cart-total").html(data.totalPrice + '<em class="unit">元</em>');
        $("#cart-goods-num").text(data.books.length);

        $(".cart-list .btn-del").click(function () {
            var request = {
                isbn: $(this).data('isbn'),
                <?= Yii::$app->request->csrfParam ?>: '<?= Yii::$app->request->csrfToken ?>'
            };
            $.post("/cart/delete", request, function (response) {
                layer.msg("<p class='success'>" + response.msg + "</p>");
                updateCart();
            }, 'json');
        });
    }

    $(window).scroll(function () {
        var a = $('#fixed-wrap');
        var e = $(window).scrollTop();
        e >= 180 ? (a.addClass("fixed"), setTimeout(function () {
            a.addClass("show")
        }, 100)) : (a.removeClass("fixed"), a.removeClass("show"))
    });
</script>
</body>
</html>

<!- Powered by TinyRise ->
