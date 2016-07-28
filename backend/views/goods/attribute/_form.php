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
    <div class="panel-body" id="js-goods-attribute">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'parent_id')->dropDownList($model->groups(), ['id' => 'js-parent-id', 'v-model' => 'parent_id']) ?>

        <div v-cloak v-if="parent_id > 0">
            <?= $form->field($model, 'type')->dropDownList($model->formTags(), ['v-model' => 'type']) ?>

            <div class="form-group" v-if="type > 1">
                <label class="col-sm-2 control-label">属性值</label>
                <div class="col-sm-8">
                    <button type="button" v-on:click="append" class="btn btn-default col-sm-2">添加</button>
                </div>
            </div>

            <template v-for="item in items" v-if="type > 1">
                <div class="form-group">
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-4">
                        <input type="text" name="Attribute[items][]" class="form-control" value="{{item.value}}" placeholder="请输入属性值">
                    </div>
                    <div class="col-sm-2">
                        <button type="button" v-on:click="remove($index)" class="btn btn-danger col-sm-10">删除</button>
                    </div>
                </div>
            </template>

        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('Goods', 'Create') : Yii::t('Goods', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php $this->registerJs(
"
    var app = new Vue({
        el: '#js-goods-attribute',
        data: {
            parent_id: " . intval($model->parent_id) . ",
            type: " . intval($model->type) . ",
            items: " . $model->items . "
        },
        methods: {
            append: function() {
                this.items.push({
                    value: ''
                });
            },
            remove: function(index) {
                this.items.splice(index, 1);
            }

        }
    });
"
); ?>

