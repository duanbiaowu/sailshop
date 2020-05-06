<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

/* @var $order Order */
/* @var OrderDetail[] $details */
/* @var PaymentType $paymentType */
/* @var double $bookTotalPrice */
/* @var double $freightPrice */
/* @var array $status */

use common\models\MemberAccountRecord;
use common\models\order\Order;
use common\models\order\OrderDetail;
use common\models\system\PaymentType;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;
use frontend\widgets\LinkPager;

?>

<link type="text/css" rel="stylesheet" href="/themes/default/css/ucenter.css">

<div class="container list blank">
    <div class="row-5">

        <?= $this->render('/member/_menu') ?>

        <div class="col-4">
            <h1 class="title"><span>我的订单：</span></h1>
            <table class="table table-list">
                <tbody>
                <tr class="title">
                    <td>
                        <b>订&nbsp;&nbsp;单&nbsp;&nbsp;号：</b> <?= $order->formatId() ?>
                    </td>
                </tr>
                <tr>
                    <td><b>订单创建：</b> <?= $order->create_time ?></td>
                </tr>
                <?php if ($order->status >= Order::PAY_STATUS): ?>
                <tr>
                    <td><b>订单支付：</b> <?= $order->create_time ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td><b>状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</b> <span class="text-gray"> <?= $status[$order->status] ?></span></td>
                </tr>
                </tbody>
            </table>
            <div>
                <table class="table table-list">
                    <tbody>
                    <tr>
                        <th class="tl" style="padding-left: 20px;" colspan="2">收货人信息：</th>
                    </tr>
                    <tr>
                        <td class="label">收货人：</td>
                        <td><?= $order->name ?></td>
                    </tr>
                    <tr>
                        <td class="label">地&nbsp;&nbsp;&nbsp;&nbsp;址：</td>
                        <td><?= $order->province_name ?> <?= $order->city_name ?> <?= $order->district_name ?> <?= $order->zip_code ?> <?= $order->detail_address ?></td>
                    </tr>
                    <tr>
                        <td class="label">手&nbsp;&nbsp;&nbsp;&nbsp;机：</td>
                        <td><?= $order->mobile ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <table class="table table-list">
                    <tbody>
                    <tr>
                        <th class="tl" style="padding-left: 20px;" colspan="2">支付及配送方式：</th>
                    </tr>
                    <tr>
                        <td class="label">支付方式：</td>
                        <td><?= $paymentType->name ?></td>
                    </tr>
                    <tr>
                        <td class="label">运&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;费：</td>
                        <td><?= $freightPrice ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div>
                <h2 class="mt20">实物图书购物清单</h2>
                <table class="table table-list" style="text-align: left;">
                    <tbody>
                    <tr>
                        <th width="40"></th>
                        <th>图书名称</th>
                        <th width="140">图书ISBN</th>
                        <th width="80">图书价格</th>
                        <th width="40">数量</th>
                        <th width="80">小计</th>
                    </tr>
                    
                    <?php foreach ($details as $detail): ?>
                    <tr>
                        <td>
                            <a href="/book/detail?isbn=<?= $detail->isbn ?>" target="_blank">
                                <img src="/<?= $detail->getIsbn0()->one()->thumbnail ?> " width="60">
                            </a>
                        </td>
                        <td>
                            <a href="/book/detail?isbn=<?= $detail->isbn ?>" target="_blank">
                                <?= $detail->getIsbn0()->one()->name ?>
                            </a>
                        </td>
                        <td><?= $detail->isbn ?></td>
                        <td>￥<?= $detail->price ?></td>
                        <td>￥<?= $detail->number ?></td>
                        <td>￥<?= sprintf('%.2f', $detail->price * $detail->number)  ?></td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <table class="table table-list tr">
                <tbody>
                <tr>
                    <td><p>图书总金额：￥<?= $bookTotalPrice ?></p></td>
                </tr>
                <tr>
                    <td><p>+ 运费：￥<?= $freightPrice ?></p></td>
                </tr>
                <tr>
                    <td style="font-size:20px">订单总金额：<b>￥<?= $order->price_count ?></b></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>