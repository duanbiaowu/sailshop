<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Specifications */
/* @var $items */

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

    <table class="table table-striped table-bordered detail-view text-center">
        <thead>
        <tr>
            <th class="text-center" width="25%">名称</th>
            <th class="text-center" width="30%">规格值</th>
            <th class="text-center" width="45%">规格值</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach($items as $index => $item): ?>
                <tr>
                    <?php if ($index == 0): ?>
                    <td rowspan="<?= count($items); ?>"><?= $model->name ?></td>
                    <?php endif; ?>
                    <td><?= $item->name ?></td>
                    <td><?= Html::img($item->images, ['width' => 100, 'height' => 100]) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>
