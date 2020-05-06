<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\system\PaymentType */

$this->title = Yii::t('System', 'Update Payment Type') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Payment Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('System', 'Update');
?>
<div class="payment-type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
