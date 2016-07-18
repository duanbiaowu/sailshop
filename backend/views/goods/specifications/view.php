<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Specifications */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'Specifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specifications-view">
    
    <p>
        <?= Html::a(Yii::t('Goods', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('Goods', 'Delete'), ['delete', 'id' => $model->id], [
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
            'id',
            'name',
            [
                'attribute' => 'parent_id',
                'value' => $model->specGroup()[$model->parent_id],
            ],
            [
                'attribute' => 'type',
                'value' => $model->specTypes()[$model->type],
            ],
        ],
    ]) ?>

    <?php if ($model->items): ?>
    <table class="table table-striped table-bordered detail-view text-center">
        <thead>
        <tr>
            <th class="text-center">规格值</th>
            <th class="text-center">规格图片</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($model->items['values'] as $index => $item): ?>
            <tr>
                <td><?= $item ?></td>
                <td><?= Html::img($model->items['images'][$index]) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif; ?>

</div>
