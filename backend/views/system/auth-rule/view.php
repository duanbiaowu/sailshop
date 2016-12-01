<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthRule */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Auth Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-rule-view">

    <p>
        <?= Html::a(Yii::t('System', 'Update'), ['update', 'id' => $model->name], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('System', 'Delete'), ['delete', 'id' => $model->name], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('System', 'common_delete_confirm'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'data:ntext',
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
