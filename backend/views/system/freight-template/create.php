<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\system\FreightTemplate */

$this->title = Yii::t('System', 'Create Freight Template');
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Freight Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="freight-template-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
