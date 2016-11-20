<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\system\FreightTemplate */

$this->title = Yii::t('System', 'Update {modelClass}: ', [
    'modelClass' => 'Freight Template',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Freight Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('System', 'Update');
?>
<div class="freight-template-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
