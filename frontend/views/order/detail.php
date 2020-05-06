<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $model \frontend\models\PasswordResetRequestForm */
/* @var MemberAccountRecord[] $records */
/* @var Pagination $pagination */
/* @var array $typeLabels */

use common\models\MemberAccountRecord;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use frontend\widgets\LinkPager;

?>

<link type="text/css" rel="stylesheet" href="/themes/default/css/ucenter.css">
<link type="text/css" rel="stylesheet" href="/themes/default/systemjs/form/style.css">
<script type="text/javascript" charset="UTF-8" src="/themes/default/systemjs/form/form.js"></script>

<div class="container list blank">
    <div class="row-5">
        <div class="col-1">
            <div id="widget_sub_navs"><div class="side-menu">
                    <h2 class="header">用户中心</h2>
                    <div class="sub-menu">
                        <h2 class="header">交易管理</h2>
                        <ul class="">

                            <li class="menu-item current"><a href="/index.php?con=ucenter&amp;act=order">我的订单<span class="l-triangle"></span></a></li>

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=refund">退款申请<span class="l-triangle"></span></a></li>

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=attention">我的关注<span class="l-triangle"></span></a></li>
                        </ul>
                        <h2 class="header">客户服务</h2>
                        <ul class="">

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=consult">商品咨询<span class="l-triangle"></span></a></li>

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=review">商品评价<span class="l-triangle"></span></a></li>

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=message">我的消息<span class="l-triangle"></span></a></li>
                        </ul>
                        <h2 class="header">账户管理</h2>
                        <ul class="">

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=info">个人资料<span class="l-triangle"></span></a></li>

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=safety">账户安全<span class="l-triangle"></span></a></li>

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=union">账号绑定<span class="l-triangle"></span></a></li>

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=address">收货地址<span class="l-triangle"></span></a></li>

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=voucher">我的优惠券<span class="l-triangle"></span></a></li>

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=account">账户金额<span class="l-triangle"></span></a></li>

                            <li class="menu-item "><a href="/index.php?con=ucenter&amp;act=point">我的积分<span class="l-triangle"></span></a></li>
                        </ul>
                    </div>
                </div>

                <!--- Powered by TinyRise ---></div>
        </div>
        <div class="col-4">
            <h1 class="title"><span>我的订单：</span></h1>
            <table class="table table-list">
                <tbody><tr class="title"><td><b>订单号：</b><i class="icon-order-0-32"></i>20200504215352998368<b>下单日期：</b>2020-05-04 21:53:52 <b>状态：</b> <span class="text-gray"><s>已作废</s></span></td>
                </tr>
                <tr><td>2020-05-04 21:53:52&nbsp;&nbsp;<span class="black">订单创建</span></td></tr>
                <tr><td><span class="black">订单20200504215352998368 已审核通过！</span></td></tr>
                </tbody></table>
            <div>
                <table class="table table-list">
                    <tbody><tr>
                        <th class="tl" style="padding-left: 20px;" colspan="2">收货人信息：</th>
                    </tr>
                    <tr>
                        <td class="label">收货人：</td>
                        <td>段彪武</td>
                    </tr>
                    <tr>
                        <td class="label">地&nbsp;&nbsp;&nbsp;&nbsp;址：</td>
                        <td>北京市 北京市 海淀区 123456</td>
                    </tr>
                    <tr>
                        <td class="label">电&nbsp;&nbsp;&nbsp;&nbsp;话：</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="label">手&nbsp;&nbsp;&nbsp;&nbsp;机：</td>
                        <td>18515135172</td>
                    </tr>
                    </tbody></table>
            </div>
            <div>
                <table class="table table-list">
                    <tbody><tr>
                        <th class="tl" style="padding-left: 20px;" colspan="2">支付及配送方式：</th>
                    </tr>
                    <tr>
                        <td class="label">支付方式：</td>
                        <td>支付宝[即时到帐]</td>
                    </tr>
                    <tr>
                        <td class="label">运&nbsp;&nbsp;&nbsp;&nbsp;费：</td>
                        <td>12.00</td>
                    </tr>
                    </tbody></table>
            </div>
            <div>
                <h2 class="mt20">实物商品购物清单</h2>
                <table class="table table-list">
                    <tbody><tr>
                        <th width="40"></th>
                        <th>商品名称</th>
                        <th width="140">商品编号</th>
                        <th width="100">规格</th>
                        <th width="80">商品价格</th>
                        <th width="80">优惠后价格</th>
                        <th width="40">数量</th>
                        <th width="80">小计</th>
                    </tr>
                    <tr class="odd">
                        <td>
                            <a href="/index.php?con=index&amp;act=product&amp;id=15" target="_blank"><img src="/data/uploads/2014/04/30/95fc43a276b4706c1eb6be35a460dcc9.jpg__100_100.jpg" width="40"></a>
                        </td>
                        <td><a href="/index.php?con=index&amp;act=product&amp;id=15" target="_blank">Apple/苹果 ipad air  WIFI iPad Air平板黑预售白现货</a>
                        </td>
                        <td>AP20140101785_4</td>
                        <td>    颜色：白色  硬盘：32G  系统：ios系统  尺寸：9.7英寸                          </td>
                        <td>￥3999.00</td>
                        <td>￥3999.00</td>
                        <td>1</td>
                        <td>￥3999.00</td>
                    </tr>
                    </tbody></table>
            </div>
            <table class="table table-list tr">
                <tbody><tr>
                    <td><p>商品总金额：￥3999.00</p></td>
                </tr>
                <tr>
                    <td><p>+ 运费：￥12.00</p></td>
                </tr>
                <tr>
                    <td><p>- 优惠：￥0.00</p></td>
                </tr>
                <tr>
                    <td style="font-size:20px">订单支付金额：<b>￥4011.00</b></td>
                </tr>
                </tbody></table>
        </div>
    </div>
</div>