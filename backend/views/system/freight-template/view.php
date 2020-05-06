<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\system\FreightTemplate */
/* @var $districts common\models\system\FreightTemplate */
/* @var $district common\models\system\FreightTemplate */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Freight Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freight-template-view">

    <p>
        <?= Html::a(Yii::t('System', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('System', 'Delete'), ['delete', 'id' => $model->id], [
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
            'weight',
            'cost',
            'append_weight',
            'append_cost',
        ],
    ]) ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th width="40%" class="text-center"><?= Yii::t('System', 'Freight Area') ?></th>
                <th width="15%" class="text-center"><?= Yii::t('System', 'Freight Weight') ?> (g)</th>
                <th width="15%" class="text-center"><?= Yii::t('System', 'Freight Cost') ?></th>
                <th width="15%" class="text-center"><?= Yii::t('System', 'Freight Append Weight') ?> (g)</th>
                <th width="15%" class="text-center"><?= Yii::t('System', 'Freight Append Cost') ?></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($districts as $district): ?>
            <tr>
                <td>
                <?php foreach($district->name as $name): ?>
                    <div class="col-sm-4"><strong><?= $name; ?></strong></div>
                <?php endforeach; ?>
                </td>
                <td class="text-primary text-center"><?= $district->weight ?></td>
                <td class="text-danger text-center"><?= $district->cost ?></td>
                <td class="text-primary text-center"><?= $district->append_weight ?></td>
                <td class="text-danger text-center"><?= $district->append_cost ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
