<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Specifications */

$this->title = Yii::t('Goods', 'Update') . ' : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'Specifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('Goods', 'Update');
?>
<div class="specifications-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
