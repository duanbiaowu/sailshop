<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\content\ArticleContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Article Contents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-content-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Article Content', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'category_id',
            'content:ntext',
            'create_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
