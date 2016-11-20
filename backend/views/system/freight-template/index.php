<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\system\FreightTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('System', 'Freight Templates');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freight-template-index">

    <p>
        <?= Html::a(Yii::t('System', 'Create Freight Template'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',
            'weight',
            'cost',
            'append_weight',
             'append_cost',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
