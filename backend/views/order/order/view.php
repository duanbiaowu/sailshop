<?php

use backend\models\system\ExpressCompany;
use common\models\order\Order;
use common\models\order\OrderDetail;
use common\models\system\PaymentType;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var common\models\order\Order $model */
/* @var OrderDetail[] $details */
/* @var PaymentType $paymentType */
/* @var ExpressCompany $expressCompany */
/* @var array $status */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => '所有订单', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-view">
    <div class="panel panel-default">
        <div class="panel-heading">图书信息</div>
        <div class="panel-body">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>封面</th>
                    <th>名称</th>
                    <th>价格</th>
                    <th>数量</th>
                    <th>小计</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($details as $detail): ?>
                    <tr>
                        <th scope="row"><?= Html::img($detail->getIsbn0()->one()->thumbnail, [
                                'width' => 60,
                            ]) ?></th>
                        <td><?= $detail->getIsbn0()->one()->name ?></td>
                        <td>￥<?= $detail->price ?></td>
                        <td><?= $detail->number ?></td>
                        <td>￥<?= sprintf('%.2f', $detail->price * $detail->number) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-default" style="display: none;">
        <div class="panel-heading">购买人信息</div>
        <div class="panel-body">
            <table class="table table-hover">
                <tbody>
                <tr>
                    <th width="100">用户名：</th>
                    <td>duanbiaowu</td>
                    <th width="100">姓名：</th>
                    <td>tester</td>
                </tr>
                <tr>
                    <th>手机：</th>
                    <td></td>
                    <th>电话：</th>
                    <td></td>
                </tr>
                <tr>
                    <th>邮箱：</th>
                    <td>774859743@qq.com</td>
                    <th> 地址：</th>
                    <td></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">订单信息</div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
//                    'member_id',
                    'price_count',

                    [
                        'label' => '订单状态',
                        'value' => $status[$model->status],
                    ],

                    'finish_time',

                    [
                        'label' => '支付方式',
                        'value' => $paymentType->name
                    ],
                    'pay_time',

                    [
                        'label' => '快递公司',
                        'value' => $expressCompany ? $expressCompany->name : '未发货'
                    ],
                    'express_code',

                    'remark',
                    'name',
                    'mobile',
//                    'province_id',
                    'province_name',
//                    'city_id',
                    'city_name',
//                    'district_id',
                    'district_name',
                    'zip_code',
                    'detail_address',
                    'create_time',
                ],
            ]) ?>
        </div>
    </div>


</div>
