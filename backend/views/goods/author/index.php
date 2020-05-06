<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\goods\AuthorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '作者列表';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('创建作者', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered text-center'],
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'name',
                'headerOptions' => ['class' => 'text-center'],
            ],
//            'url:url',
            [
                'attribute' => 'logo',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::img($data->logo, [
                        'width' => 120,
                        'title' => $data->name,
                    ]);
                },
                'headerOptions' => ['class' => 'text-center'],
            ],
            [
                'attribute' => 'sort',
                'headerOptions' => ['class' => 'text-center', 'width' => '10%'],
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

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;{delete}',
            ],
        ],
    ]); ?>

</div>
