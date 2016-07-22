<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\system\ExpressCompany */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'id' => 'express-company-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
    ],
]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        请设置快递公司的信息
    </div>

    <div class="panel-body">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint('请输入快递公司名称，比如 顺丰') ?>

        <?= $form->field($model, 'identifier')->textInput(['maxlength' => true])->hint('请输入公司标识符号，比如 shunfeng') ?>

        <?= $form->field($model, 'code')->textInput(['maxlength' => true])->hint('请输入公司 CODE 码，主要用于接口查询服务') ?>

        <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint('请输入快递公司官方主页') ?>

        <?= $form->field($model, 'sort')->textInput()->hint('请输入快递公司的显示排序，默认为 0') ?>

        <?= $form->field($model, 'available')->hint('请选择快递是否使用快递公司')->radioList(
            $model->availableLabel(),
            ['item' => function($index, $label, $name, $checked, $value) {
                return Html::radio($name, $checked, ['value' => $value, 'label' => $label, 'labelOptions' => ['class' => 'radio-inline']]);
            }]
        ) ?>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => 'col-sm-1 ' . ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary')]) ?>
</div>

<?php ActiveForm::end(); ?>


