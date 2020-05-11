<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

/* @var Order[] $orders */

/* @var Pagination $pagination */

use common\models\order\Order;
use frontend\widgets\LinkPager;
use yii\data\Pagination;

?>


<script src="/themes/default/vendors/raphael-min.js" type="text/javascript"></script>
<script src="/themes/default/vendors/jquery.ratemate.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="/themes/default/css/ucenter.css">

<div class="container list blank">
    <div class="row-5">

        <?= $this->render('/member/_menu') ?>

        <div class="col-4">
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div id="field-info" class="alert alert-success" role="alert" style="width: 335px;">
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <h1 class="title"><span>图书评价：</span></h1>
            <div class="tab" index="0">
                <ul class="tab-head">
                    <li>待评价图书<i></i></li>
                    <li><a href="record">已评价图书<i></i></a></li>
                </ul>
                <div class="tab-body">
                    <div id="review-n">
                        <table class="table table-list" style="text-align: left;">
                            <tbody>
                            <tr>
                                <th width="160">订单编号</th>
                                <th>图书</th>
                                <th width="140">购买时间</th>
                                <th width="80">评价</th>
                            </tr>
                            </tbody>
                            <tbody class="page-content">
                            <?php foreach ($orders as $order): ?>
                            <tr class="odd">
                                <td><?= $order->formatId() ?></td>
                                <td>
                                    <?php foreach ($order->getOrderDetails()->all() as $number => $detail): ?>
                                    <a href="/book/detail?isbn=<?= $detail->isbn ?>" target="_blank">
                                        <?= $number + 1 ?>. <?= $detail->getIsbn0()->one()->name ?>
                                    </a>
                                    <br />
                                    <?php endforeach; ?>
                                </td>
                                <td><?= $order->create_time ?></td>
                                <td><a class="btn btn-main btn-mini" href="create?id=<?= $order->id ?>">评价</a></td>
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
        </div>
    </div>
</div>