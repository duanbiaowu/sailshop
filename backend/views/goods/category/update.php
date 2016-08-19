<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Category */
/* @var $categories */

$this->title = Yii::t('Goods', 'Update', [
    'modelClass' => 'Category',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('Goods', 'Update');
?>
<div class="category-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
