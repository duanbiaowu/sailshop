<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('System', 'Goods');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <p>
        <?= Html::a(Yii::t('System', 'Create Goods'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'category_id',
            'type_id',
            'brand_id',
            // 'unit',
            // 'thumbnail',
            // 'attributes',
            // 'show_pictures',
            // 'seo_title',
            // 'seo_keyword',
            // 'seo_description',
            // 'account_count',
            // 'status',
            // 'detail_link',
            // 'modified_time',
            // 'create_time',
            // 'goods_sku',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
