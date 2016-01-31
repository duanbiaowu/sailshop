<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Brand */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'id' => 'brand-form',
    'options' => [
        'class' => 'form-horizontal',
        'enctype' => 'multipart/form-data',
    ],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
    ],
]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::decode(Yii::t('Goods', 'brand_form_title')) ?>
    </div>
    <div class="panel-body">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true])->hint(Yii::t('Goods', 'brand_form_name_hint')) ?>

        <?= $form->field($model, 'url')->textInput(['maxlength' => true])->hint(Yii::t('Goods', 'brand_form_url_hint')) ?>

        <?= $form->field($model, 'logo')->fileInput()->hint(Yii::t('Goods', 'brand_form_logo_hint')) ?>

        <?= $form->field($model, 'sort')->textInput()->hint(Yii::t('Goods', 'brand_form_sort_hint')) ?>

        <?= $form->field($model, 'available')->hint(Yii::t('Goods', 'brand_form_available_hint'))->radioList(
            \common\models\Available::labels(),
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
