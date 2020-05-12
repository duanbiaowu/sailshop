<?php

use common\models\MemberAccountRecord;
use common\models\MemberSearch;
use common\models\order\Order;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AccountRecordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', '用户资金记录日志');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-account-record-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            [
                'attribute' => 'id',
                'filterInputOptions' => ['style' => 'display: none;'],
            ],
            [
                'attribute' => 'member_id',
                'label' => '用户名',
                'value' => function ($data) {
                    return $data->getMember()->one()->username;
                },
            ],
            [
                'attribute' => 'type',
                'value' => function ($data) {
                    return MemberAccountRecord::typeLabels()[$data->type];
                },
                'filter' => MemberAccountRecord::typeLabels(),
            ],
            'value',
            'remark',
            [
                'attribute' => 'create_time',
                'filterInputOptions' => ['style' => 'display: none;'],
            ],
        ]
    ]); ?>

</div>