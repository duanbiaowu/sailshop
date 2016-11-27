<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\system\FreightTemplate */
/* @var $regions */
/* @var $districts */

$this->title = Yii::t('System', 'Update Freight Template') . ' - ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Freight Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('System', 'Update');
?>
<div class="freight-template-update">

    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
        'districts' => $districts,
    ]) ?>

</div>
