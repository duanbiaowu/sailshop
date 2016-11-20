<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Goods */
/* @var $categories */
/* @var $brands */
/* @var $attributeGroup */
/* @var $form yii\widgets\ActiveForm */
/* @var $specs */
/* @var $sku */
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

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
            <?= Yii::t('Goods', 'Goods Form Basic') ?>
        </a>
    </li>

    <li role="presentation">
        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
            <?= Yii::t('Goods', 'Goods Form Brand') ?>
        </a>
    </li>
    <li role="presentation">
        <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
            <?= Yii::t('Goods', 'Goods Form Sku') ?>
        </a>
    </li>
    <li role="presentation">
        <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
            <?= Yii::t('Goods', 'Goods Form Seo') ?>
        </a>
    </li>
</ul>

<div class="form-group"></div>

<div class="panel panel-default" id="js-goods-detail" v-cloak="">
    <div class="panel-body">
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="home">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'category_id')->dropDownList($categories) ?>

                <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'thumbnail')->widget(FileInput::className(), [
                    'buttonTag' => 'button',
                    'buttonName' => '<i class="fa fa-image"></i> 选择图片',
                    'buttonOptions' => ['class' => 'btn btn-default'],
                    'options' => ['class' => 'form-control'],
                    'template' => '<div class="input-group col-sm-12">{input}<span class="input-group-btn">{button}</span></div>',
                    'imageContainer' => '#js-images-container',
                ]) ?>

                <div class="form-group">
                    <label class="col-sm-2 control-label" for="brand-logo"></label>
                    <div class="col-sm-10" id="js-images-container">
                        <?php if (!$model->isNewRecord): ?>
                            <?= Html::img($model->thumbnail, ['title' => $model->name]) ?>
                        <?php endif; ?>
                    </div>
                </div>

                <div id="js-slide-container">
                    <div class="form-group">
                        <label class="col-sm-2 control-label"><?= Yii::t('Goods', 'Goods Show Pictures') ?></label>
                        <div class="col-sm-8">
                            <button type="button" id="js-slide-append" class="btn btn-default col-sm-2">添加</button>
                        </div>
                    </div>

                    <?php if ($model->show_pictures): ?>
                        <?php foreach ($model->show_pictures as $picture): ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <?php echo FileInput::widget([
                                    'id' => 'item-' . mt_rand(1, 102400),
                                    'name' => 'Goods[show_pictures][]',
                                    'value' => $picture,
                                    'buttonTag' => 'button',
                                    'buttonName' => '选择',
                                    'buttonOptions' => ['type' => 'button', 'class' => 'btn btn-default'],
                                    'options' => ['class' => 'form-control', 'placeholder' => '请选择图片'],
                                    'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                                    'thumb' => 'original',
                                    'imageContainer' => '.img',
                                    'pasteData' => FileInput::DATA_ID,
                                ]) ?>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-danger col-sm-10 js-slide-delete">删除</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    <?php endif ?>
                </div>

                <?= $form->field($model, 'status')->radioList(
                    \common\models\Available::labels(),
                    [
                        'item' => function($index, $label, $name, $checked, $value) {
                            return Html::radio($name, $checked, ['value' => $value, 'label' => $label, 'labelOptions' => ['class' => 'radio-inline']]);
                         }
                    ]
                ) ?>
            </div>

            <div role="tabpanel" class="tab-pane" id="profile">
                <div class="form-group">
                <?php foreach ($brands as $brand): ?>
                    <div class="col-sm-2">
                        <?= Html::img($brand['logo'], ['width' => '100%', 'height' => '100%']) ?>
                        <div class="help-block text-center">
                            <?= Html::radio('Goods[brand_id]', $model->brand_id == $brand['id'], [
                                'value' => $brand['id'],
                                'label' => '&nbsp;&nbsp;' . $brand['name']
                            ]) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>

                <div class="form-group">
                    <label class="col-sm-2 control-label"><?= Yii::t('Goods', 'Goods Attribute Group'); ?></label>
                    <div class="col-sm-6">
                        <?= Html::dropDownList('attribute_group', $model->attributes['index'], $attributeGroup, [
                            'class' => 'form-control',
                            'prompt' => Yii::t('Goods', 'attribute_form_title'),
                            'v-model' => 'attribute',
                            'v-on:change' => 'renderAttribute'
                        ]) ?>
                    </div>
                </div>
                <div class="form-group" v-for="form in attributeForms">
                    <label class="col-sm-2 control-label">{{form.name}}</label>
                    <div class="col-sm-6">
                        {{{form.html}}}
                    </div>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="messages">
                <?php
                Modal::begin([
                    'header' => '<h4 class="modal-title">' . Yii::t('Goods', 'Goods Form Sku Select') . '</h4>',
                    'options' => [
                        'id' => 'js-spec-form',
                        'backdrop' => 'static',
                        'keyboard' => 'false',
                    ],
                    'size' => 'modal-lg',
                    'toggleButton' => [
                        'tag' => 'button',
                        'label' => Yii::t('Goods', 'Goods Form Sku Select'),
                        'class' => 'btn btn-success',
                    ],
                    'footer' => '<button type="button" class="btn btn-default" v-on:click="renderSkuTable" data-dismiss="modal">生成规格表格</button><button class="btn btn-default" data-dismiss="modal">关闭</button>'
                ]);

                echo $this->render('sku_form', [
                    'model' => $model,
                    'specs' => $specs,
                    'sku' => $model->isNewRecord ? [] : $sku,
                ]);

                Modal::end();
                ?>

                <button style="display: none;" type="button" class="btn btn-success col-sm-2 pull-right" v-on:click="skuBatchSetting">批量设置价格库存</button>

                <div class="form-group"></div>

                <table class="table" v-bind:style="{display: skuBatchInfo.status}">
                    <tbody>
                        <tr>
                            <th width="40%">
                                <span class="glyphicon glyphicon-info-sign"></span>
                                请填写价格库存,属性值和表格相对应。
                            </th>
                            <th width="12%"><input type="text" class="form-control" v-on:blur="skuBatchSetting" v-model="skuBatchInfo.items.cost_price"></th>
                            <th width="12%"><input type="text" class="form-control" v-on:blur="skuBatchSetting" v-model="skuBatchInfo.items.market_price"></th>
                            <th width="12%"><input type="text" class="form-control" v-on:blur="skuBatchSetting" v-model="skuBatchInfo.items.sale_price"></th>
                            <th width="12%"><input type="text" class="form-control" v-on:blur="skuBatchSetting" v-model="skuBatchInfo.items.stock"></th>
                            <th width="12%"><input type="text" class="form-control" v-on:blur="skuBatchSetting" v-model="skuBatchInfo.items.weight"></th>
                        </tr>
                    </tbody>

                </table>

                <table class="table table-bordered text-center">
                    <thead>
                        <tr>
                            <th class="text-center" width="40%">名称</th>
                            <th class="text-center" width="12%">成本价格</th>
                            <th class="text-center" width="12%">市场价格</th>
                            <th class="text-center" width="12%">销售价格</th>
                            <th class="text-center" width="12%">库存</th>
                            <th class="text-center" width="12%">重量</th>
                        </tr>
                    </thead>
                    <tbody id="js-sku-combination">
                        <tr v-for="item in skuCombination">
                            <td>{{item.name}}</td>
                            <td><input type="text" name="cost_price[{{item.index}}]" class="form-control" v-on:blur="format($event)" value="{{skuCombinationValue[item.index].cost_price}}"></td>
                            <td><input type="text" name="market_price[{{item.index}}]" class="form-control" v-on:blur="format($event)" value="{{skuCombinationValue[item.index].market_price}}"></td>
                            <td><input type="text" name="sale_price[{{item.index}}]" class="form-control" v-on:blur="format($event)" value="{{skuCombinationValue[item.index].sale_price}}"></td>
                            <td><input type="text" name="stock[{{item.index}}]" class="form-control" v-on:blur="format($event)" value="{{skuCombinationValue[item.index].stock}}"></td>
                            <td><input type="text" name="weight[{{item.index}}]" class="form-control" v-on:blur="format($event)" value="{{skuCombinationValue[item.index].weight}}"></td>
                        </tr>
                    </tbody>
                </table>

            </div>

            <div role="tabpanel" class="tab-pane" id="settings">
                <?= $form->field($model, 'seo_title')->textarea(['maxlength' => true]) ?>

                <?= $form->field($model, 'seo_keyword')->textarea(['maxlength' => true]) ?>

                <?= $form->field($model, 'seo_description')->textarea(['maxlength' => true]) ?>
            </div>

        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('Goods', 'Create') : Yii::t('Goods', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php $this->registerJsFile('@web/js/goods.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>

<?php $this->registerJs(
    '   Goods.attributeValue = ' . ($model->attributes['items'] === null ? "{}" : $model->attributes['items']) . ';
        Goods.skuCombinationValue=  ' . ($model->isNewRecord ?  "[]"  : json_encode($sku['items'])) . ';
        Goods.renderAttribute();
        Goods.renderSkuTable(); ' .

    <<<EOF
    $('#js-slide-append').on('click', function() {
        $.post('slide-form', {}, function(response) {
            $('#js-slide-container').append(response);
        });
    });

    $('#js-slide-container').delegate('.js-slide-delete', 'click', function() {
        $(this).parent().parent().remove();
    });

    $('#js-goods-detail').delegate('.js-check-all', 'click', function() {
        $(this).parent().parent().next().find('input:checkbox').prop('checked', $(this).prop('checked')); 
    });
EOF
); ?>