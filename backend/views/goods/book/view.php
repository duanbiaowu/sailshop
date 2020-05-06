<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Goods */
/* @var $category common\models\goods\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-view">

    <p>
        <?= Html::a(Yii::t('Goods', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('Goods', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('Goods', 'Are you sure you want to delete this item?'),
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
                'attribute' => 'category_id',
                'value' => $category->name
            ],
//            'type_id',
//            'brand_id',
            'unit',
            [
                'attribute' => 'thumbnail',
                'format' => 'html',
                'value' => Html::img($model->thumbnail, ['width' => '50', 'height' => 50])
            ],
//            'attributes',

            'seo_title',
            'seo_keyword',
            'seo_description',
//            'account_count',
            'status',
            'modified_time',
            'create_time',
//            'goods_sku',
        ],
    ]) ?>

    <table class="table table-striped table-bordered detail-view text-center">
        <tbody>
        <?php foreach ($model->show_pictures as $index => $picture): ?>
        <tr>
            <?php if ($index == 0): ?>
            <td rowspan="<?= count($model->show_pictures) ?>" width="30%"><?= Yii::t('Goods', 'Goods Show Pictures') ?></td>
            <?php endif; ?>
            <td><?= Html::img($picture, ['width' => '100', 'height' => 100]) ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

</div>
