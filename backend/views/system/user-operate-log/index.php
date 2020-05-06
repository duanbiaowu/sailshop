<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\system\UserOperateLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户操作日志';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-operate-log-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'user_id',
            'username',
            'menu_name',
            'permission',
             'query',
             'create_time',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
