<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Brand */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<p class="brand-view">

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
