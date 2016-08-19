<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-view">

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
                'value' => \common\models\goods\Category::parentFormat($model->path)
            ],
            'sort',
            'seo_title',
            'set_keyword',
            'seo_description',
        ],
    ]) ?>

</div>
