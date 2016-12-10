<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\system\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $roles */

$this->title = Yii::t('System', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <p>
        <?= Html::a(Yii::t('System', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'tableOptions' => ['class' => 'table table-striped table-bordered text-center'],

        'columns' => [
            [
                'attribute' => 'username',
                'headerOptions' => ['class' => 'text-center', 'width' => '20%'],
            ],
            [
                'attribute' => 'role_id',
                'format' => 'raw',
                'value' => function($model) {
                    $roles = \backend\models\system\AuthRole::getAuthRoles();
                    if (isset($roles[$model->role_id])) {
                        return $roles[$model->role_id];
                    }
                },
                'filter' => Html::activeDropDownList($searchModel, 'role_id', \backend\models\system\AuthRole::getAuthRoles(), [
                    'class' => 'form-control',
                    'prompt' => Yii::t('System', 'common_whole'),
                ]),
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
