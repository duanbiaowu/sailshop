<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Goods */
/* @var $categories */
/* @var $brands */
/* @var $attributeGroup */
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
                        'v-on:click' => "skuForm('" . Url::toRoute(['sku', 'id' => $model->id]) . "')",
                    ],
                ]);

                Modal::end();
                ?>
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


<?php $this->registerJs(
    '   Goods.attributeValue = ' . $model->attributes['items'] . ';
        Goods.renderAttribute();' .

    <<<EOF
    $('#js-slide-append').on('click', function() {
        $.post('slide-form', {}, function(response) {
            $('#js-slide-container').append(response);
        });
    });

    $('#js-slide-container').delegate('.js-slide-delete', 'click', function() {
        $(this).parent().parent().remove();
    });

//    $('#js-spec-form').on('hide.bs.modal', function(e) {
//        Goods.hidden(e);
//    });
EOF
); ?>