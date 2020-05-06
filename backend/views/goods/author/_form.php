<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Author */
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

        <?= $form->field($model, 'logo')->widget(FileInput::className(), [
            'buttonTag' => 'button',
            'buttonName' => '<i class="fa fa-image"></i> 选择图片',
            'buttonOptions' => ['class' => 'btn btn-default'],
            'options' => ['class' => 'form-control'],
            'template' => '<div class="input-group col-sm-8">{input}<span class="input-group-btn">{button}</span></div>',
            'imageContainer' => '#js-images-container',
        ]) ?>

        <div class="form-group">
            <label class="col-sm-2 control-label" for="brand-logo"></label>
            <div class="col-sm-10" id="js-images-container">
                <?php if (!$model->isNewRecord): ?>
                    <?= Html::img($model->logo, ['title' => $model->name]) ?>
                <?php endif; ?>
            </div>
        </div>

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
    <?= Html::submitButton($model->isNewRecord ? Yii::t('Goods', 'Create') : Yii::t('Goods', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>
