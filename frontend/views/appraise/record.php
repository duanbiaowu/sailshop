<?php
/**
 * @link: http://www.h2o-china.com
 * @Copyright (c) 2017 E20-Framework
 * @author Biaowu Duan <codean.net@gmail.com>
 * @version 1.0
 */

/* @var Order[] $orders */
/* @var array $records */
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
            <div class="tab">
                <ul class="tab-head">
                    <li class="current">已评价图书<i></i></li>
                    <li><a href="index">待评价图书<i></i></a></li>
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
                                <td>
                                    <?php if ($records[$order->id]['cCount'] < ($records[$order->id]['bCount'] * 2)): ?>
                                    <div style="display: block; margin-bottom: 5px;">
                                    <a class="btn btn-main btn-mini" href="append?id=<?= $order->id ?>">追评</a>
                                    </div>
                                    <?php endif; ?>
                                    <a href="javascript:;" class="btn btn-main btn-mini js-appraise-view-btn" data-link="content?id=<?= $order->id ?>">查看评论</a>
                                </td>
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

<script>
    $(".js-appraise-view-btn").on("click", function () {

        // $(this).data('link')
        var link = $(this).data('link');
        layer.open({
            type: 2,
            title: '订单评价',
            shadeClose: true,
            shade: 0.8,
            area: ['960px', '580px'],
            content: link,
            cancel: function (index, layero) {}
        });
        return false;
    });
</script>