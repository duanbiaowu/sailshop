<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\order\OrderAppraiseSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '图书评论');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-appraise-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'attribute' => 'isbn',
                'label' => '图书',
                'value' => function($model) {
                    return $model->getIsbn0()->one()->name;
                }
            ],
            'content:ntext',
            [
                'attribute' => 'score',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::tag('span', str_repeat('★', $model->score), [
                        'style' => 'color: red;',
                    ]);
                },
                'filter' => Html::activeDropDownList($searchModel, 'score', [
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                    5 => 5,
                ],
                [
                    'class' => 'form-control',
                    'prompt' => '',
                ]),
            ],
            [
                'attribute' => 'create_time',
                'filterInputOptions' => ['style' => 'display: none;'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}',
            ],
        ],
    ]); ?>

</div>
