<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\goods\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('Goods', 'categories');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="category-index">
    <p>
        <?= Html::a(Yii::t('Goods', 'create_category'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'parent_id',
            'type_id',
            'path',
            // 'sort',
            // 'seo_title',
            // 'set_keyword',
            // 'seo_description',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
