<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Attribute */
/* @var $searchModel common\models\goods\AttributeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('Goods', 'attributes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-index">
    <p>
        <?= Html::a(Yii::t('Goods', 'create_attribute'), ['create'], ['class' => 'btn btn-success']) ?>
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
                'value' => function($model) {
                    return $model->groups()[$model->parent_id];
                },
                'filter' => Html::activeDropDownList($searchModel, 'parent_id', $model->groups(), [
                    'class' => 'form-control',
                    'prompt' => Yii::t('System', 'common_whole'),
                ]),
                'headerOptions' => ['class' => 'text-center', 'width' => '25%'],
            ],
            [
                'attribute' => 'type',
                'value' => function($model) {
                    return $model->parent_id ? $model->formTags()[$model->type] : '';
                },
                'filter' => Html::activeDropDownList($searchModel, 'type', $model->formTags(), [
                    'class' => 'form-control',
                    'prompt' => Yii::t('System', 'common_whole'),
                ]),
                'headerOptions' => ['class' => 'text-center', 'width' => '25%'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
