<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\system\FreightTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'id' => 'freight-template-form',
    'options' => [
        'class' => 'form-horizontal',
    ],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-9">{input}{error}{hint}</div>',
    ],
]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('System', 'Create Freight Template') ?>
    </div>
    <div class="panel-body">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <label class="col-sm-2 control-label"><?= Yii::t('System', 'Freight Template Default') ?></label>
            <div class="col-sm-10">
                <div class="col-sm-6">
                    <?= $form->field($model, 'weight')->textInput() ?>
                 </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'cost')->textInput() ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'append_weight')->textInput() ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'append_cost')->textInput() ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-1"></div>
            <div class="col-sm-11">
                <button type="button" class="btn btn-success" v-on:click="append">
                    <span class="glyphicon glyphicon-plus"></span> <?= Yii::t('System', 'Area Freight Template') ?>
                </button>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-1"></div>
            <div class="col-sm-11">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="35%" class="text-center"><?= Yii::t('System', 'Freight Area') ?></th>
                            <th width="15%" class="text-center"><?= Yii::t('System', 'Freight Weight') ?> (g)</th>
                            <th width="15%" class="text-center"><?= Yii::t('System', 'Freight Cost') ?></th>
                            <th width="15%" class="text-center"><?= Yii::t('System', 'Freight Append Weight') ?> (g)</th>
                            <th width="15%" class="text-center"><?= Yii::t('System', 'Freight Append Cost') ?></th>
                            <th width="5%" class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="area in areas">
                            <td>
                                <template v-if="area.name">
                                    Hello World
                                </template>
                                <span class="glyphicon glyphicon-edit pull-right" v-on:click="setArea(area.id || '')"></span>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="FreightTemplate[weight][{{area.id || ''}}]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="FreightTemplate[weight][{{area.id || ''}}]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="FreightTemplate[weight][{{area.id || ''}}]">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="FreightTemplate[weight][{{area.id || ''}}]">
                            </td>
                            <td class="text-center">
                                <span class="glyphicon glyphicon-remove" v-on:click="remove($index)"></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('System', 'Create') : Yii::t('System', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php
Modal::begin([
    'header' => '<h4 class="modal-title">' . Yii::t('System', 'Area Select') . '</h4>',
    'options' => [
        'id' => 'js-area-form',
        'backdrop' => 'static',
        'keyboard' => 'false',
    ],
    'size' => 'modal-lg',
    'footer' => '<button type="button" class="btn btn-default" data-dismiss="modal">生成规格表格</button><button class="btn btn-default" data-dismiss="modal">关闭</button>'
]);



Modal::end();
?>

<?php $this->registerJsFile('@web/js/freight.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>

