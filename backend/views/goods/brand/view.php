<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Brand */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-view">
    <div class="row form-group">
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
            [
                'attribute' => 'url',
                'format' => 'html',
                'value' => Html::a($model->url, $model->url, ['target' => '_blank']),
            ],
            [
                'attribute' => 'logo',
                'format' => 'html',
                'value' => Html::img($model->logo, [
                    'title' => $model->name,
                ]),
            ],
            'sort',
            'available',
        ],
    ]) ?>

</div>
