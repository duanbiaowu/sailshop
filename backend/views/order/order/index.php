<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\order\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'member_id',
            'price_count',
            'status',
            'finish_time',
            // 'pay_type',
            // 'pay_time',
            // 'express_type',
            // 'express_code',
            // 'remark',
            // 'name',
            // 'mobile',
            // 'province_id',
            // 'province_name',
            // 'city_id',
            // 'city_name',
            // 'district_id',
            // 'district_name',
            // 'zip_code',
            // 'detail_address',
            // 'create_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
