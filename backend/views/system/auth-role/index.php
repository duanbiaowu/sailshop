<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\system\AuthRoleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('System', 'Auth Roles');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-role-index">

    <p>
        <?= Html::a(Yii::t('System', 'Create Auth Role'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered text-center'],

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'name',
                'headerOptions' => ['class' => 'text-center', 'width' => '50%'],
            ],


            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;{delete}',
            ],
        ],
    ]); ?>

</div>
