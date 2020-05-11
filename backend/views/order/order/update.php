<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\order\Order */

$this->title = '更新订单' . $model->id;
$this->params['breadcrumbs'][] = ['label' => '所有订单', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="order-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
