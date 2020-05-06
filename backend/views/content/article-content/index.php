<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\content\ArticleContentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var array $categories */

$this->title = '全部文章';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-content-index">

    <p>
        <?= Html::a('创建文章', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'title',
                'headerOptions' => ['width' => '13%'],
            ],
            [
                'attribute' => 'category_id',
                'value' => function($model) use ($categories) {
                    return $categories[$model->category_id]['name'];
                },
                'headerOptions' => ['width' => '10%'],
            ],
            'content:ntext',
            [
                'attribute' => 'create_time',
                'headerOptions' => ['width' => '15%'],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;{delete}',
            ],
        ],
    ]); ?>

</div>
