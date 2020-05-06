<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\goods\TypeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="type-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'attributes') ?>

    <?= $form->field($model, 'specifications') ?>

    <?= $form->field($model, 'brands') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('Goods', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('Goods', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
