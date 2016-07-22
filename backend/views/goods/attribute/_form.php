<?php

use common\models\Available;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Attribute */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'id' => 'attribute-form',
    'options' => [
        'class' => 'form-horizontal',
    ],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
    ],
]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::decode(Yii::t('Goods', 'attribute_form_title')) ?>
    </div>
    <div class="panel-body">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'parent_id')->dropDownList($model->groups()) ?>

        <?= $form->field($model, 'type')->dropDownList($model->formTags()) ?>

        <?= $form->field($model, 'items')->textarea(['rows' => 5, 'maxlength' => true]) ?>

        <?= $form->field($model, 'available')->radioList(
            Available::labels(),
            ['item' => function($index, $label, $name, $checked, $value) {
                return Html::radio($name, $checked, ['value' => $value, 'label' => $label, 'labelOptions' => ['class' => 'radio-inline']]);
            }]
        ) ?>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('Goods', 'create') : Yii::t('Goods', 'update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

