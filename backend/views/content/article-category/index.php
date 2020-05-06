<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\content\ArticleCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Article Categories';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article Category', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'parent_id',
            'sort',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
