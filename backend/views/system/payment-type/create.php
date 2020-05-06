<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\system\PaymentType */

$this->title = 'Create Payment Type';
$this->params['breadcrumbs'][] = ['label' => 'Payment Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
