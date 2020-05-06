<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model common\models\system\FreightTemplate */
/* @var $form yii\widgets\ActiveForm */
/* @var $regions */
/* @var $districts */
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

<div class="panel panel-default" xmlns="http://www.w3.org/1999/html">
    <div class="panel-heading">
        <?= Yii::t('System', 'Create Freight Template') ?>
    </div>
    <div class="panel-body">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <label class="col-sm-1 control-label"></label>
            <div class="col-sm-10">
                <div class="col-sm-6">
                    <?= $form->field($model, 'weight')->textInput([
                        'placeholder' => '单位(g)'
                    ]) ?>
                 </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'cost')->textInput([
                        'placeholder' => '单位(元)'
                    ]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'append_weight')->textInput([
                        'placeholder' => '单位(g)'
                    ]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($model, 'append_cost')->textInput([
                        'placeholder' => '单位(元)'
                    ]) ?>
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
                        <tr v-for="(areaIndex, area) in areas">
                            <td>
                                <div class="col-sm-10">
                                    <span v-for="city in area.cities" class="text-danger">
                                        <strong v-if="$index < 3">{{city.name}} | </strong>
                                        <input type="hidden" name="district[name][{{areaIndex}}][]" value="{{city.id}}|{{city.name}}">
                                    </span>
                                    <span class="text-primary" v-if="area.cities.length">
                                        ... 等 {{area.cities.length}} 个城市
                                    </span>
                                </div>
                                <div class="col-sm-2 pull-right">
                                    <span class="glyphicon glyphicon-edit pull-right" v-on:click="setArea($index)"></span>
                                </div>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="district[weight][{{area.id || ''}}]" value="{{attributes[areaIndex].weight}}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="district[cost][{{area.id || ''}}]" value="{{attributes[areaIndex].cost}}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="district[append_weight][{{area.id || ''}}]" value="{{attributes[areaIndex].append_weight}}">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="district[append_cost][{{area.id || ''}}]" value="{{attributes[areaIndex].append_cost}}">
                            </td>
                            <td width="5%" class="text-center">
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
    <?= Html::submitButton($model->isNewRecord ? Yii::t('System', 'Create') : Yii::t('System', 'Update'), [
        'class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1',
    ]) ?>
</div>

<?php
Modal::begin([
    'header' => '<h4 class="modal-title">' . Yii::t('System', 'Area Select') . '</h4>',
    'options' => [
        'id' => 'js-area-form',
        'backdrop' => 'static',
        'keyboard' => 'false',
    ],
    'size' => 'modal-lg',
    'footer' => '<button class="btn btn-default" v-on:click="create" data-dismiss="modal">确定</button><button class="btn btn-default" data-dismiss="modal">关闭</button>'
]);
?>

<div class="input-group col-sm-12">
    <div class="col-sm-3">
        <ul class="list-group">
            <a v-for="region in regions" href="#js-spec-group-{{region.id}}" class="list-group-item" data-toggle="tab" aria-expanded="true">
                <span class="badge"></span>{{region.name}}
            </a>
        </ul>
    </div>

    <div class="col-sm-9">
        <div class="tab-content">
            <div v-for="(index, region) in regions" class="tab-pane fade{{$index == 0 ? ' active in' : ''}}" id="js-spec-group-{{region.id}}">
                <div class="panel panel-default" v-for="area in region.areas">
                    <div class="panel-heading">
                        <label class="checkbox-inline {{area.disabled}}">
                            <input type="checkbox" v-model="area.checked" v-if="area.disabled.length" v-on:click="checkAll(index, area.id, $event)" disabled>
                            <input type="checkbox" v-model="area.checked" v-else v-on:click="checkAll(index, area.id, $event)" >
                            {{area.name}}
                        </label>
                    </div>
                    <div class="panel-body">
                        <div class="col-sm-3 help-block" v-for="city in area.cities">
                            <label class="checkbox-inline {{city.disabled}}">
                                <input type="checkbox" v-if="city.disabled.length" v-on:click="checkSingle(index, area.id, $event)" v-model="city.checked" value="{{city.id}}" disabled>
                                <input type="checkbox" v-else v-on:click="checkSingle(index, area.id, $event)" v-model="city.checked" value="{{city.id}}">
                                {{city.name}}
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
Modal::end();
?>

<?php ActiveForm::end(); ?>

<?php $this->registerJsFile('@web/js/freight.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>

<?php $this->registerJs(
    '
    Freight.regions = ' . json_encode($regions) . ';
    Freight.areas = ' . json_encode($districts['name']) . ';
    Freight.attributes = ' . json_encode($districts['attributes']) . ';
    
    '

) ?>
