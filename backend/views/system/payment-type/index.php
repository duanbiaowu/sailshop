<?php

use common\models\system\PaymentType;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\system\PaymentTypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model PaymentType */

$this->title = Yii::t('System', 'Payment Types');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="payment-type-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'logo',
                'value' => function($model) {
                    return Html::img(Yii::$app->params['siteBaseInfo']['siteUrl'] . $model->logo, [
                        'width' => 150,
                    ]);
                },
                'format' => 'raw',
                'contentOptions' => ['height' => '100px'],
            ],
            'name',
            'app_key',
            'app_secret',
            [
                'attribute' => 'description',
                'contentOptions' => ['width' => '60%'],
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    return $model->status ? '开启' : '关闭';
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}'
            ],
        ],
    ]); ?>

</div>
