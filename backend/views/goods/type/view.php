<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Type */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-view">
    <div class="form-group row">
        <div class="col-sm-1">
            <?= Html::a(Yii::t('Goods', 'update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary col-sm-12']) ?>
        </div>
        <div class="col-sm-1">
            <?= Html::a(Yii::t('Goods', 'delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger col-sm-12',
                'data' => [
                    'confirm' => Yii::t('System', 'common_delete_confirm'),
                    'method' => 'post',
                ],
            ]) ?>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'attributes:ntext',
            'specifications:ntext',
            'brands:ntext',
        ],
    ]) ?>

</div>
