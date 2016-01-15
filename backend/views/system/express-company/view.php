<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\system\ExpressCompany */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => '快递公司', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="express-company-view">

    <div class="row form-group">
        <div class="col-sm-1">
            <?= Html::a('更新', ['update', 'id' => $model->id], ['class' => 'btn btn-primary col-sm-12']) ?>
        </div>
        <div class="col-sm-1">
            <?= Html::a('删除', ['delete', 'id' => $model->id], [
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
            'identifier',
            'code',
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => Html::a($model->url, $model->url, ['target' => '_blank']),
            ],
            'sort',
            [
                'attribute' => 'available',
                'format' => 'raw',
                'value' => $model->availableLabel()[$model->available],
            ],
        ],
    ]) ?>

</div>
