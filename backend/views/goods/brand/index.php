<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\goods\BrandSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('Goods', 'brands');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-index">

    <p>
        <?= Html::a(Yii::t('Goods', 'create_brand'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered text-center'],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'name',
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function($data) { return Html::a($data->url, $data->url, ['target' => '_blank']); },
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'logo',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::img($data->logo, [
                        'width' => 60,
                        'height' => 60,
                        'title' => $data->name,
                    ]);
                },
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'sort',
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'available',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::tag('span', \common\models\Available::getLabel($data->available), [
                        'class' => \common\models\Available::getStyle($data->available),
                    ]);
                },
                'filter' => Html::activeDropDownList($searchModel, 'available', \common\models\Available::labels(), [
                    'class' => 'form-control',
                    'prompt' => Yii::t('System', 'common_whole'),
                ]),
                'headerOptions' => ['class' => 'text-center'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
