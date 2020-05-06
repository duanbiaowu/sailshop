<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Type */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('Goods', 'update');
?>
<div class="type-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
