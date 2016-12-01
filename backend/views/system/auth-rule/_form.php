<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthRule */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'id' => 'auth-rule-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
    ],
]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('System', 'Set User Info') ?>
    </div>

    <div class="panel-body">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'data')->textarea(['rows' => 3]) ?>

    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('System', 'Create') : Yii::t('System', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

