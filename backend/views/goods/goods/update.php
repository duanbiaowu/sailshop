<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Goods */
/* @var $categories */
/* @var $brands */
/* @var $authors */
/* @var $goodsAuthors */

$this->title = Yii::t('Goods', 'Update Goods') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('Goods', 'Update');
?>
<div class="goods-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'brands' => $brands,
        'authors' => $authors,
        'goodsAuthors' => $goodsAuthors,
    ]) ?>

</div>
