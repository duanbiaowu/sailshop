<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

use common\models\order\Order;use common\models\order\OrderDetail;

/* @var Order $model */
/* @var OrderDetail[] $details */
/* @var double $bookTotalPrice */
/* @var double $freightPrice */

?>


<!DOCTYPE html>
<html>
<head>
    <title>清单打印</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="author" content="designer:webzhu, date:2012-03-23"/>
    <link rel="stylesheet" href="http://tinyshop.e20.net/static/css/base.css"/>
    <link rel="stylesheet" href="http://tinyshop.e20.net/static/css/admin.css"/>
    <link rel="stylesheet" href="http://tinyshop.e20.net/static/css/font_icon.css"/>
    <script type="text/javascript" charset="UTF-8" src="http://tinyshop.e20.net/runtime/systemjs/jquery.min.js"></script>
    <script type="text/javascript" src="http://tinyshop.e20.net/static/js/common.js"></script>
    <!--[if lte IE 7]>
    <script src="http://tinyshop.e20.net/static/css/fonts/lte-ie7.js"></script><![endif]-->
</head>
<body style="background: none;">
<style media="print" type="text/css">
    .noprint {
        display: none
    }

    body {
        font-size: 8pt;
    }
</style>
<link rel="stylesheet" type="text/css" media="screen,print" href="http://tinyshop.e20.net/static/css/print.css"/>
<div class="panel">
    <table style="border-top:none;">
        <tr>
            <td><img src="http://www.sailshop.com/images/logo.png" width="224" height="74" /></td>
            <td valign="bottom" align="rgiht" width="240"><p>客户：<?= $model->name ?> &nbsp;&nbsp;<span class="ml_20">电话：<?= $model->mobile ?></span>
                </p></td>
        </tr>
    </table>
    <table>
        <tr>
            <td><b>订单号：<?= $model->formatId() ?> </b></td>
            <td align="right" width="240px"><b>订购日期：<?= $model->create_time ?> </b></td>
        </tr>
    </table>
    <table style="border:none;">
        <tr>
            <th width="40">序号</th>
            <th width="100">ISBN</th>
            <th width="200">名称</th>
            <th width="80">单价</th>
            <th width="60">数量</th>
            <th width="80">小计</th>
        </tr>
        <?php foreach ($details as $detail): ?>
        <tr>
            <td>1</td>
            <td><?= $detail->isbn ?></td>
            <td><?= $detail->getIsbn0()->one()->name ?></td>
            <td>￥<?= $detail->price ?></td>
            <td><?= $detail->number ?></td>
            <td>￥<?= sprintf('%.2f', $detail->price * $detail->number) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <table>
        <tr>
            <td>订单附言：</td>
            <td width="300">
                <ul>
                    <li><span class="caption">图书价格：</span>￥<?= $bookTotalPrice ?> 元</li>
                    <li><span class="caption">配送费用：</span>￥<?= $freightPrice ?> 元</li>
                    <li><b><span class="caption">应付总金额：</span>￥<?= $model->price_count ?> 元</b></li>
                </ul>
            </td>
        </tr>
    </table>
    <table>
        <tr>
            <td align="left"><img src="http://tinyshop.e20.net/index.php?con=ajax&act=test&code=<?= $model->formatId() ?>"/>
            </td>
            <td align="right">© 扬帆书店 2019 - 2099</td>
        </tr>
    </table>
    <div><input class="button noprint" type="submit" onclick="window.print();" value="打印"/></div>
</div>
</body>
</html>
<!- Powered by TinyRise ->
