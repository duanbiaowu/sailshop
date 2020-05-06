<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

use common\models\order\Order;
use common\models\system\PaymentType;

/* @var Order $model */
/* @var PaymentType $paymentType */

?>


<link rel="stylesheet" href="/themes/default/css/simple.css">
<script type="text/javascript" charset="UTF-8"
        src="/themes/default/systemjs/artdialog/artDialog.js?skin=simple"></script>

<div id="widget_sub_navs">
    <ul class="crumbs clearfix mt15 step-4">
        <li class="pass">4、订购完成<em></em><i></i></li>
        <li class="pass">3、选择支付<em></em><i></i></li>
        <li class="pass">2、确认订单信息<em></em><i></i></li>
        <li class="pass">1、购物车<em></em><i></i></li>
    </ul>
    <!--- Powered by TinyRise --->
</div>

<div class="container">
    <div class="status-bar">
        <span>
        <i class='icon-success-48'></i>支付成功，订购已完成！
        </span>
    </div>
    <div>
        <table class="table table-line">
            <tr>
                <td style="width:200px;">订单编号：</td>
                <td>
                    <i class="icon-order-{$order['type']}"></i><?= $model->formatId() ?> &nbsp;&nbsp;&nbsp;&nbsp;
                </td>
            </tr>
            <tr>
                <td style="width:200px;">订单金额：</td>
                <td class="red"><?= $model->price_count ?></td>
            </tr>
            <tr>
                <td style="width:200px;">支付方式：</td>
                <td id="pay_name"><?= $paymentType->name ?></td>
            </tr>
        </table>
    </div>
    <div class="blank">
        <p class="tc mb10 ">
            <a class="btn btn-main" href="/">继续购书</a>&nbsp;&nbsp;
            <a class="btn btn-gray" href="/order/index">查看订单</a>
        </p>
    </div>
</div>

