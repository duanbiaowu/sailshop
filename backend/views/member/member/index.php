<?php

use backend\models\system\User;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\system\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var User $model */
/* @var array $roles */

$this->title = Yii::t('System', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?= Html::a(Yii::t('System', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
//        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered text-center'],

        'columns' => [
            [
                'attribute' => 'nickname',
                'headerOptions' => ['class' => 'text-center', 'width' => '12%'],
            ],
            [
                'format' => 'raw',
                'value' => function($model) use ($roles) {
                    $result = [];
                    foreach ($model->getRoles()->asArray()->all() as $value) {
                        $result[] = $roles[$value['role_id']]['name'];
                    }
                    return implode('&nbsp;&nbsp;', $result);
                },
                'headerOptions' => ['class' => 'text-center', 'width' => '11%'],
            ],
            [
                'attribute' => 'email',
                'format' => 'email',
                'headerOptions' => ['class' => 'text-center', 'width' => '15%'],
            ],
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    return '<span class="label label-' . $model->statusStyle()[$model->status] .'">' .
                            $model->statusLabel()[$model->status] . '</span>';
                },
                'filter' => Html::activeDropDownList($searchModel, 'status', $searchModel->statusLabel(), [
                    'class' => 'form-control',
                    'prompt' => Yii::t('System', 'common_whole'),
                ]),
                'headerOptions' => ['class' => 'text-center', 'width' => '10%'],
            ],
            [
                'attribute' => 'created_at',
                'value' => function($model) {
                    return Yii::$app->formatter->format($model->created_at, 'date');
                },
                'filter' => '',
                'headerOptions' => ['class' => 'text-center', 'width' => '12%'],
            ],
            [
                'attribute' => 'updated_at',
                'value' => function($model) {
                    return Yii::$app->formatter->format($model->updated_at, 'date');
                },
                'filter' => '',
                'headerOptions' => ['class' => 'text-center', 'width' => '12%'],
            ],
            [
                'format' => 'raw',
                'value' => function($model) {
                    return Html::a('角色设置', ['/system/user/role', 'id' => $model->id], [
                        'class' => 'btn btn-warning btn-sm',
                    ]);
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}&nbsp;&nbsp;{delete}',
            ],
        ],
    ]); ?>

</div>
