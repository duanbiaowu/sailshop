<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\order\OrderAppraise */

$this->title = Yii::t('app', 'Create Order Appraise');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Order Appraises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-appraise-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
