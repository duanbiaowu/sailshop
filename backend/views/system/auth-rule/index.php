<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\system\AuthRuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('System', 'Auth Rules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-rule-index">
    <p>
        <?= Html::a(Yii::t('System', 'Create Auth Rule'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'tableOptions' => ['class' => 'table table-striped table-bordered text-center'],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'headerOptions' => ['class' => 'text-center', 'width' => '35%'],
            ],
            [
                'attribute' => 'created_at',
                'value' => function($model) {
                    return Yii::$app->formatter->format($model->created_at, 'date');
                },
                'headerOptions' => ['class' => 'text-center', 'width' => '20%'],
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return Yii::$app->formatter->format($model->updated_at, 'date');
                },
                'headerOptions' => ['class' => 'text-center', 'width' => '20%'],
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
