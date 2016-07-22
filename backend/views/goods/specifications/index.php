<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\goods\SpecificationsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $specModel common\models\goods\Specifications */

$this->title = Yii::t('Goods', 'Specifications');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specifications-index">

    <p>
        <?= Html::a(Yii::t('Goods', 'Create Specifications'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered text-center'],

        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'headerOptions' => ['class' => 'text-center', 'width' => '5%'],
            ],

            [
                'attribute' => 'name',
                'headerOptions' => ['class' => 'text-center', 'width' => '25%'],
            ],
            [
                'attribute' => 'parent_id',
                'format' => 'raw',
                'value' => function($data) {
                    return \common\models\goods\Specifications::specGroup()[$data->parent_id];
                },
                'headerOptions' => ['class' => 'text-center', 'width' => '35%'],
            ],
            [
                'attribute' => 'type',
                'format' => 'raw',
                'value' => function($data) {
                    return \common\models\goods\Specifications::specTypes()[$data->type];
                },
                'filter' => Html::activeDropDownList($searchModel, 'type', \common\models\goods\Specifications::specTypes(), [
                    'class' => 'form-control',
                    'prompt' => Yii::t('System', 'common_whole'),
                ]),
                'headerOptions' => ['class' => 'text-center', 'width' => '15%'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
