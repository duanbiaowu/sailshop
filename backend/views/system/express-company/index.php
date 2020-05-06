<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\system\ExpressCompanySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '快递公司';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="express-company-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建快递公司', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered text-center'],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'identifier',
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'code',
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function($data) { return Html::a($data->url, $data->url, ['target' => '_blank']); },
                'headerOptions' => ['class' => 'text-center'],
            ],

            [
                'attribute' => 'available',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->available ? '启用' : '禁用';
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
            ],
        ],

        'pager' => [
            'firstPageLabel' => '第一页',
            'lastPageLabel' => '最后一页',
        ],
    ]); ?>

</div>
