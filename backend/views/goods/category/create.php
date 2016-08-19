<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\goods\Category */
/* @var $categories */

$this->title = Yii::t('Goods', 'Create Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
