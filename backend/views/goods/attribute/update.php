<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Attribute */

$this->title =  Yii::t('Goods', 'Update') . ' : ' . $model->name;
$this->params['breadcrumbs'][] = ['label' =>  Yii::t('Goods', 'attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] =  Yii::t('Goods', 'Update');
?>
<div class="attribute-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
