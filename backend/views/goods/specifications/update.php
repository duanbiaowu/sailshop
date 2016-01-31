<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Specifications */

$this->title = Yii::t('System', 'Update {modelClass}: ', [
    'modelClass' => 'Specifications',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Specifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('System', 'Update');
?>
<div class="specifications-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
