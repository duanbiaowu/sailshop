<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Category */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories */
?>

<?php
$form = ActiveForm::begin([
    'id' => 'category-form',
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
        <?= Html::decode(Yii::t('Goods', 'Category Form Title')) ?>
    </div>

    <div class="panel-body" v-cloak id="js-goods-category">
        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <div class="form-group field-category-parent_id has-success">
            <label class="col-sm-2 control-label" for="category-parent_id">上级分类</label>
            <div class="col-sm-8">
                <select v-model="selected" id="category-parent_id" class="form-control" name="Category[parent_id]">
                    <option v-for="option in options" v-bind:value="option.id">
                        {{ option.name }}
                    </option>
                </select>
                <div class="help-block"></div>
            </div>
        </div>

        <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true, 'placeholder' => Yii::t('Goods', 'Category Form SEO')]) ?>

        <?= $form->field($model, 'set_keyword')->textarea(['maxlength' => true, 'placeholder' => Yii::t('Goods', 'Category Form SEO')]) ?>

        <?= $form->field($model, 'seo_description')->textarea(['rows' => 5, 'maxlength' => true, 'placeholder' => Yii::t('Goods', 'Category Form SEO')]) ?>
    </div>

</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('Goods', 'Create') : Yii::t('Goods', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php $this->registerJs(

"
    var app = new Vue({
        el: '#js-goods-category',
        data: {
            selected: " . intval($model->parent_id) . ",
            options: " . $categories . ",
            separator: '— — '
        },
        methods: {
            init: function() {
                var tree = this.arrayToTree(0);
                this.options = new Array(this.options[0]);
                this.format(tree, 0);
            },

            arrayToTree: function(parentId) {
                var temp = [];
                for (var i in this.options) {
                      if (parentId == this.options[i].parent_id) {
                          temp.push({
                              value: this.options[i],
                              children: this.arrayToTree(this.options[i].id)
                          });
                      }
                }
                return temp;
            },

            format: function(tree, depth) {
                for (var i in tree) {
                    this.options.push({
                        id: tree[i].value.id,
                        name: this.repeat(depth) + tree[i].value.name
                    });

                    if (tree[i].children.length) {
                        this.format(tree[i].children, depth + 1);
                    }
                }
            },

            repeat: function(number) {
                number = parseInt(number);
                var result = '';
                for (var i = 0; i < number; i++) {
                    result += this.separator;
                }
                return result;
            }
        }
    });

    app.init();
"
) ?>