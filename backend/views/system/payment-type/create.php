<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\system\PaymentType */

$this->title = Yii::t('System', 'Create Payment Type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Payment Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
