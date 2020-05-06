<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\goods\Goods */
/* @var $categories */
/* @var $brands */
/* @var $authors */
/* @var $goodsAuthors */

$this->title = Yii::t('Goods', 'Create Goods');
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'Goods'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="goods-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
        'brands' => $brands,
        'authors' => $authors,
    ]) ?>

</div>
