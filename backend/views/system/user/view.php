<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\system\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">
    <p>
        <?= Html::a(Yii::t('System', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('System', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('System', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => '<span class="label label-' . $model->statusStyle()[$model->status] . '">' . $model->statusLabel()[$model->status] . '</span>',
            ],
            'email:email',
            [
                'attribute' => 'created_at',
                'value' => Yii::$app->formatter->format($model->created_at, 'date'),
            ],
            [
                'attribute' => 'updated_at',
                'value' => Yii::$app->formatter->format($model->created_at, 'date'),
            ],
        ],
    ]) ?>

</div>
