<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Attribute */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-view">

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
                'value' => $model->groups()[$model->parent_id]
            ],
            [
                'attribute' => 'type',
                'value' => $model->formTags()[$model->type]
            ],
        ],
    ]) ?>

    <?php if ($model->items): ?>
        <table class="table table-striped table-bordered detail-view text-center">
            <tbody>
            <?php foreach($model->items as $index => $item): ?>
            <tr>
                <?php if ($index == 0): ?>
                <td rowspan="<?= count($model->items) ?>">属性值</td>
                <?php endif; ?>
                <td><?= $item['value'] ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</div>
