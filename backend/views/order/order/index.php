<?php

use common\models\order\Order;
use common\models\system\PaymentType;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel common\models\order\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $status */
/* @var array $paymentTypes */

$this->title = '订单管理';
$this->params['breadcrumbs'][] = $this->title;

Modal::begin([
    'options' => [
        'id' => 'js-order-delivery-modal',
        'backdrop' => 'static',
        'keyboard' => 'false',
    ],
    'size' => 'modal-sm',
    'toggleButton' => [
        'tag' => 'button',
        'label' => '订单详情',
        'class' => 'js-order-view btn btn-success hidden',
        'data-link' => Url::toRoute('detail'),
    ],
]);

Modal::end();

?>


    <div class="order-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'attribute' => 'id',
                    'headerOptions' => ['style' => 'width: 60px;'],
                ],
//            'member_id',
                'price_count',

                [
                    'attribute' => 'create_time',
                    'headerOptions' => ['style' => 'width: 160px;'],
                    'filterInputOptions' => ['style' => 'display: none;'],
                ],

                [
                    'attribute' => 'status',
                    'value' => function ($data) use ($status) {
                        return $status[$data->status];
                    },
                    'filter' => Order::formatStatus(),
                ],

                [
                    'attribute' => 'pay_type',
                    'value' => function ($data) use ($paymentTypes) {
                        return $paymentTypes[$data->pay_type];
                    },
                    'filter' => $paymentTypes,
                ],
                [
                    'attribute' => 'pay_time',
                    'headerOptions' => ['style' => 'width: 160px;'],
                    'filterInputOptions' => ['style' => 'display: none;'],
                ],

                // 'express_type',
                // 'express_code',

                [
                    'attribute' => 'finish_time',
                    'headerOptions' => ['style' => 'width: 160px;'],
                    'filterInputOptions' => ['style' => 'display: none;'],
                ],
                'name',
                'mobile',

//             'province_id',
//            'province_name',
//             'city_id',
//            'city_name',
//             'district_id',
//            'district_name',
//            'zip_code',
//            'detail_address',
//            'remark',

                [
                    'attribute' => '操作',
                    'format' => 'raw',
                    'value' => function($data) {
                        if (in_array($data->status, [Order::REJECTED_STATUS, Order::CONSULTED_STATUS])) {
                            $html = Html::button('设置协商结果', [
                                'data-link' => Url::to(['consulted',
                                    'id' => $data->id,
                                    'redirect' => urlencode(Url::current())
                                ]),
                                'class' => 'btn btn-primary btn-sm js-order-delivery-btn',
                            ]);
                        } else if ($data->status > Order::DELIVERED_STATUS) {
                            $html =  '';
                        } else {
                            $html = Html::button('发货', [
                                'data-link' => Url::to(['delivery',
                                    'id' => $data->id,
                                    'redirect' => urlencode(Url::current())
                                ]),
                                'class' => 'btn btn-primary btn-sm js-order-delivery-btn',
                            ]);
                        }

                        return $html . '<p></p>' . Html::a('打印订单清单', ['print', 'id' => $data->id], [
                                'class' => 'btn btn-primary btn-sm',
                                'target' => '_blank',
                            ]);
                    },
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'headerOptions' => ['style' => 'width: 180px;'],
                    'template' => '{view} {delete}'
                ],
            ],
        ]); ?>

    </div>


<?php $this->registerJs(
    <<<EOF
    $('.js-order-delivery-btn').on('click', function() {
        $.get($(this).data('link'), function(response) {
            $('#js-order-delivery-modal').html(response).modal();
        });
    });
EOF
); ?>