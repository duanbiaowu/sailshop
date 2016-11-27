<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\system\FreightTemplate */
/* @var $regions */
/* @var $districts */

$this->title = Yii::t('System', 'Create Freight Template');
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Freight Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freight-template-create">

    <?= $this->render('_form', [
        'model' => $model,
        'regions' => $regions,
        'districts' => $districts,
    ]) ?>

</div>
