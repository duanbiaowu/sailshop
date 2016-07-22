<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
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
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'parent_id',
            'type',
            'items',
            'available',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
