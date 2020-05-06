<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TinyShop大型电子商务系统</title>
    <meta name="keywords" content="泰创软件科技有限公司|Tiny系列产品">
    <meta name="description" content="工匠精神、细节、点滴、开源、高效、安全">
    <link rel="shortcut icon" href="/favicon.ico"/>
    <link rel="bookmark" href="/favicon.ico" />
    <link rel="stylesheet" href="/themes/default/css/common.css">
    <link rel="stylesheet" href="/themes/default/vendors/awesome/css/font-awesome.min.css">
    <style type="text/css">
        .js-template{display:none !important;}
    </style>
    <script type="text/javascript" src="/themes/default/vendors/jquery.min.js"></script>
    <script type="text/javascript" src="/themes/default/js/common.min.js"></script>
    <script type="text/javascript" src="/themes/default/vendors/layer/layer.js"></script>
    <script type="text/javascript">
        var server_url = '/__con__/__act__';
        var Tiny = {user:{name:'duanbiaowu',id:'2',online:true}};
    </script>
</head>

<body>
<!-- S 页头部分 -->
<div id="header">
    <div class="top-bar">
        <div class="container top-layout">
            <div class="sub-1">
                TinyShop大型电子商务系统                </div>
            <div class="sub-2">
                <ul class="nav-x">
                    <li class="item dropdown">
                        <a href="/index.php?con=ucenter&act=index">会员中心<i class="fa"></i></a>
                        <div class="dropdown-content user-box">
                            <ul class="user-center">
                                <li class="link"><a href="/index.php?con=ucenter&act=order">我的订单</a></li>
                                <li class="link"><a href="/index.php?con=ucenter&act=review">商品评价</a></li>
                                <li class="link"><a href="/index.php?con=ucenter&act=address">收货地址</a></li>
                                <li class="link"><a href="/index.php?con=ucenter&act=safety">账户安全</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="item split"></li>
                    <li class="item">你好,duanbiaowu!<a href="/index.php?con=simple&act=logout"> 安全退出</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="fixed-top-nav">
        <div id="fixed-wrap">
            <div  class="container">
                <div class="header-main">
                    <div class="sub-1"><h1>扬帆书店</h1></div>
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
                                    <a href="/index.php?con=simple&act=cart" class="btn btn-main fr">去购物车结算</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sub-2">
                        <form id="search-form" class="search-form" action="/index.php?con=" method="get">
                            <input type="hidden" name="con" value="index">
                            <input type="hidden" name="act" value="search"> <input type='hidden' name='tiny_token_' value='lqd2nvhc0ywy163g20ubwjrewkdgkxbt'/>
                            <input class="search-keyword" id="search-keyword" class="txt-keyword" name="keyword" value="" type="text">
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
                    <a href="javascript:;">全部商品分类<i class="triangle-b"></i></a>
                </div>
                <ul class="category">
                    <li>
                        <a href="/index.php?con=index&act=category&cid=5">
                            服饰<i class="fa">&#xf105;</i>
                        </a>
                        <div class="category-sub">
                            <ul class="sub">
                                <li>
                                    <h5>
                                        <a href="/index.php?con=index&act=category&cid=6">
                                            女装                                            </a>
                                    </h5>
                                    <p>
                                        <a href="/index.php?con=index&act=category&cid=7">
                                            衬衫                                            </a>                                           </p>
                                </li>
                                <li>
                                    <h5>
                                        <a href="/index.php?con=index&act=category&cid=8">
                                            男式                                            </a>
                                    </h5>
                                    <p>
                                        <a href="/index.php?con=index&act=category&cid=9">
                                            衬衫                                            </a>                                           </p>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="/index.php?con=index&act=category&cid=1">
                            电脑、手机<i class="fa">&#xf105;</i>
                        </a>
                        <div class="category-sub">
                            <ul class="sub">
                                <li>
                                    <h5>
                                        <a href="/index.php?con=index&act=category&cid=3">
                                            笔记本                                            </a>
                                    </h5>
                                    <p>
                                    </p>
                                </li>
                                <li>
                                    <h5>
                                        <a href="/index.php?con=index&act=category&cid=2">
                                            手机                                            </a>
                                    </h5>
                                    <p>
                                    </p>
                                </li>
                                <li>
                                    <h5>
                                        <a href="/index.php?con=index&act=category&cid=4">
                                            平板                                            </a>
                                    </h5>
                                    <p>
                                    </p>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </li>

            <li class="link"><a href="/index.php?con=index&act=index">首页</a></li>

        </div>
    </ul>
</div>
<!-- E 页头部分 -->
<!-- S 主体部分 -->
<div id="main">
    <div class="banner swiper" style="height: 396px;" config-data="{'direction': 'left'}">
        <ul class="cycle-slideshow">
            <li style="background-image:url(http://tinyshop.e20.net/data/uploads/2014/05/13/b5cf5e20eda87a3ff77e4a2d33828947.jpg) ">
                <a href="/" target="_blank"></a>
            </li>
            <li style="background-image:url(http://tinyshop.e20.net/data/uploads/2014/05/13/9670df531a008c75e7bed5b8967efd66.gif) ">
                <a href="/" target="_blank"></a>
            </li>
        </ul>
    </div>
    <div class="container">
        <div class="sub-1">
            <div class="list">
                <ul class="row-5 category-index">
                    <li class="col title">
                        <fieldset class="line-title">
                            <legend align="center">服饰</legend>
                        </fieldset>
                    </li>

                    <li class="col-4">
                        <ul class="row">
                            <li class="col-1">
                                <div class="item">
                                    <div class="header">
                                        <a href="/index.php?con=index&act=product&id=16"><img src="http://tinyshop.e20.net/data/uploads/2014/04/30/62527b26f1afbe204f247b72d1f20c2d.jpg__220_220.jpg" width=$w></a>
                                    </div>
                                    <ul class="main">
                                        <li class="title"><a href="/index.php?con=index&act=product&id=16">BRIOSO格子衬衫 女 长袖2014春装新款女装修身韩版大码百搭衬衣潮</a></li>
                                        <li class="price">49.00元</li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
                <ul class="row-5 category-index">
                    <li class="col title">
                        <fieldset class="line-title">
                            <legend align="center">电脑、手机</legend>
                        </fieldset>
                    </li>
                    <li class="col-4">
                        <ul class="row">

                            <li class="col-1">
                                <div class="item">
                                    <div class="header">
                                        <a href="/index.php?con=index&act=product&id=16"><img src="http://tinyshop.e20.net/data/uploads/2014/04/30/62527b26f1afbe204f247b72d1f20c2d.jpg__220_220.jpg" width=$w></a>
                                    </div>
                                    <ul class="main">
                                        <li class="title"><a href="/index.php?con=index&act=product&id=16">BRIOSO格子衬衫 女 长袖2014春装新款女装修身韩版大码百搭衬衣潮</a></li>
                                        <li class="price">49.00元</li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

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
                <dt class="icon-3"></dt>
                <dd>
                    <p class="title">极速更新</p>
                    <p>所有商品信息及时更新</p>
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
            <ul class="sub-1">
                <li class="title">购物指南</li>
                <li><a href="/index.php?con=index&act=help&id=3">账户注册</a></li>
                <li><a href="/index.php?con=index&act=help&id=5">购物流程</a></li>
                <li><a href="/index.php?con=index&act=help&id=6">积分制度</a></li>
            </ul>
            <ul class="sub-2">
                <li class="title">配送方式</li>
                <li><a href="/index.php?con=index&act=help&id=7">配送范围</a></li>
            </ul>
            <ul class="sub-3">
                <li class="title">支付方式</li>
                <li><a href="/index.php?con=index&act=help&id=8">余额支付</a></li>
            </ul>
            <ul class="sub-4">
                <li class="title">售后服务</li>
                <li><a href="/index.php?con=index&act=help&id=9">退款说明</a></li>
                <li><a href="/index.php?con=index&act=help&id=13">售后保障</a></li>
            </ul>
            <ul class="sub-5 footer-content">
                <li class="title">联系我们：</li>
                <li class="qcode">
                    <img width="130px" src="/themes/default/images/weixin.jpg">
                    <p>扫描二维码关注我们</p>
                </li>
                <li>泰创软件科技（济南）有限公司</li>
                <li>TEL：0531 - 88688232&nbsp;&nbsp; EMAIL：tinyrise@tinyrise.com</li>
            </ul>
        </div>
        <div class="footer-bottom">
            <div>                </div>
            Powered by TinyShop © 2013-2020 tinyrise.com . 保留所有权利 。
        </div>
    </div>
</div>
<!-- E 页脚部分 -->


<script type="text/javascript">
    $(".swiper").TinySwiper();

    $(".category li").mouseenter(function() {
        $(this).addClass("hover");
    }).mouseleave(function() {
        $(this).removeClass("hover");
    });

    $(".category-box").mouseenter(function() {
        $(this).addClass("on");
    }).mouseleave(function() {
        $(this).removeClass("on");
    });

    $("#tags-list a").each(function() {
        $(this).on("click", function() {
            $("#search-keyword").val($(this).text());
            $("#search-form").submit();
        })
    });

    var barLink = new Array(),
        current = -1;
    $(".tiny-bar .link").each(function(i) {
        barLink[i] = false;

        $(this).on('click', function() {
            $(".tiny-bar .link").removeClass("on");
            if(!Tiny.user.online){
                layer.open({
                    id:'loginDialog',
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

    function loginMin(){
        layer.open({
            id:'loginDialog',
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

    function removeCartActive(){
        $("#shopping-cart").removeClass('cart-active');
    }
    var cartSleep = null;
    $("#shopping-cart").mouseenter(function(){
        clearTimeout(cartSleep);
        var currentNode = $(this);
        if(!currentNode.hasClass('cart-active')){
            currentNode.addClass("cart-active");
            updateCart();
        }
    }).mouseleave(function(){
        cartSleep = setTimeout("removeCartActive()",2000);
    });
    function updateCart(data){
        if(data==null){
            $.get("/index.php?con=index&act=cart_get",function(data){
                if(data){
                    updateInfo(data);
                }
            },'json');
        }else{
            updateInfo(data);
        }
    }

    function updateInfo(data)
    {
        var card_items = '';
        var total = 0.00;
        var goods_num = 0;
        for(var i in data){
            var spec = data[i]['spec'];
            var spec_str = '';

            for(var k in spec){
                spec_str +='<span class="spec">'+spec[k]['value'][2]+"</span>";
            }
            total += parseFloat(data[i]['amount']);
            goods_num += data[i]['num'];
            card_items +='<li> <div class="cart-item"> <a class="thumb" href="" target="_blank" ><img src="/'+data[i]['img']+'" width="50" height="50"> </a> <a class="name" href=""> <span class="title">'+data[i]['name']+'</span>'+spec_str+'</a> <span class="price">'+(parseInt(data[i]['price']))+'元 × '+data[i]['num']+'</span> <a class="btn-del fr" productid="'+data[i]['id']+'" href="javascript:;"><i class="icon-close-16"></i></a></div> </li>';
        }
        if(card_items=='') card_items='<li> <div style="line-height:80px;text-align:center;">购物车中还没有商品，赶紧选购吧！</div> </li>';
        $(".cart-list").html(card_items);
        $(".cart-total").html(total.toFixed(2)+'<em class="unit">元</em>');
        $("#cart-goods-num").text(goods_num);
        $(".cart-list .btn-del").click(function(){
            var id = $(this).attr("productid");
            $.post("/index.php?con=index&act=cart_del",{id:id},function(data){
                if(data){
                    updateCart();
                }
            },'json');
        });
    }
    $(window).scroll(function() {
        var a = $('#fixed-wrap');
        var e = $(window).scrollTop();
        e >= 180 ? (a.addClass("fixed"), setTimeout(function() {
            a.addClass("show")
        }, 100)) : (a.removeClass("fixed"), a.removeClass("show"))
    });
</script>
</body>
</html>

<!- Powered by TinyRise ->
