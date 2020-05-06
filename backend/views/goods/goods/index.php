<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\goods\GoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $categories */
/* @var array $brands */

$this->title = Yii::t('Goods', 'Goods');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-index">

    <p>
        <?= Html::a(Yii::t('Goods', 'Create Goods'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'category_id',
                'value' => function($model) use ($categories) {
                    return $categories[$model->category_id]['name'];
                }
            ],
            [
                'attribute' => 'brand_id',
                'value' => function($model) use ($brands) {
                    return $brands[$model->brand_id]['name'];
                }
            ],
             'unit',
            [
                'attribute' => 'thumbnail',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::img($data->thumbnail, [
                        'width' => 100,
                        'height' => 100,
                        'title' => $data->name,
                    ]);
                },
                'headerOptions' => ['class' => 'text-center'],
            ],
//             'attributes',
//             'show_pictures',
//             'seo_title',
//             'seo_keyword',
//             'seo_description',
             [
                 'attribute' => 'status',
                 'value' => function($model) {
                     return $model->status ? '上架' : '下架';
                 },
             ],
//             'modified_time',
             'create_time',
//             'goods_sku',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;{delete}',
            ],
        ],
    ]); ?>

</div>
