<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

/* @var Order[] $orders */
/* @var array $status */
/* @var Pagination $pagination */

use common\models\order\Order;
use frontend\widgets\LinkPager;
use yii\data\Pagination;

?>


<link type="text/css" rel="stylesheet" href="/themes/default/css/ucenter.css">

<div class="container list blank">
    <div class="row-5">
        <?= $this->render('/member/_menu') ?>

        <div class="col-4">
            <h1 class="title"><span>我的订单：</span></h1>
            <table class="table table-list" style="text-align: left;">
                <tbody>
                <tr>
                    <th>订单编号</th>
                    <th width="100">收货人</th>
                    <th width="100">订单金额</th>
                    <th width="160">下单时间</th>
                    <th width="166">订单状态</th>
                </tr>
                <?php foreach ($orders as $index => $order): ?>
                <tr class="<?php if ($index % 2): ?>>odd<?php else: ?>even<?php endif ?>">
                    <td>
                        <a href="/order/detail?id=<?= $order->id ?>">
                            <i style="height: 32px; display: inline-block; vertical-align: middle;">&nbsp;</i>
                            <?= $order->formatId() ?>
                        </a>
                    </td>
                    <td><?= $order->name ?></td>
                    <td>￥<?= $order->price_count ?></td>
                    <td><?= $order->create_time ?></td>

                    <?php if ($order->status != Order::NOT_PAYING_STATUS): ?>
                    <td>
                        <span class="text-gray"><?= $status[$order->status] ?></span>
                        <?php if ($order->status == Order::DELIVERED_STATUS): ?>
                        <a class="btn btn-main btn-mini pull-right" href="https://www.kuaidi100.com/all/hhair56.shtml?mscomnu=<?= $order->express_code ?>" target="_blank">
                            查看物流
                        </a>
                        <?php endif; ?>
                    </td>
                    <?php else: ?>
                    <td>
                        <span class="text-danger">等待付款
                            <a href="/order/status?id=<?= $order->id ?>" class="btn btn-main btn-mini" target="_blank">付款</a>
                        </span>
                    </td>
                    <?php endif; ?>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <?php echo LinkPager::widget([
                'pagination' => $pagination,
                'nextPageLabel' => '下一页',
                'prevPageLabel' => '上一页',
                'options' => ['class' => 'page-nav'],
            ]); ?>
        </div>

    </div>
</div>
