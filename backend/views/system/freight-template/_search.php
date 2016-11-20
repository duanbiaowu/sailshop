<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\system\FreightTemplateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="freight-template-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'weight') ?>

    <?= $form->field($model, 'cost') ?>

    <?= $form->field($model, 'append_weight') ?>

    <?php // echo $form->field($model, 'append_cost') ?>

    <?php // echo $form->field($model, 'default') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('System', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('System', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
