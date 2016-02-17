<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Brand */

$this->title = Yii::t('Goods', 'update') . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('Goods', 'update');
?>
<div class="brand-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
