<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\system\UserOperateLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User Operate Logs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-operate-log-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User Operate Log', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'username',
            'menu_name',
            'permission',
            // 'query',
            // 'create_time',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
