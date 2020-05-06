<?php

use yii\bootstrap\Modal;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\FileInput;


/* @var $this yii\web\View */
/* @var $model common\models\goods\Book */
/* @var $categories */
/* @var $brands */
/* @var $authors */
/* @var $bookAuthors */
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
            基本信息
        </a>
    </li>

    <li role="presentation">
        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
            出版社信息
        </a>
    </li>
    <li role="presentation">
        <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
            作者信息
        </a>
    </li>
</ul>

<div class="form-group"></div>

<div class="panel panel-default" id="js-goods-detail" v-cloak="">
    <div class="panel-body">
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="home">
                <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'category_id')->dropDownList($categories) ?>

                <?= $form->field($model, 'introduce')->textarea(['maxlength' => true, 'rows' => 5]) ?>

                <?= $form->field($model, 'pages')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'publish_date')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'translator')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'price')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'stock')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'binding')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'weight')->textInput(['maxlength' => true])->hint('单位(g)') ?>

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
                        <label class="col-sm-2 control-label">展览图</label>
                        <div class="col-sm-8">
                            <button type="button" id="js-slide-append" class="btn btn-default col-sm-2">添加</button>
                        </div>
                    </div>

                    <?php if ($model->show_pictures): ?>
                        <?php foreach ($model->show_pictures as $picture): ?>
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <?php $containerId = uniqid(); ?>
                                <?php echo FileInput::widget([
                                    'id' => 'item-' . $containerId,
                                    'name' => 'Book[show_pictures][]',
                                    'value' => $picture,
                                    'buttonTag' => 'button',
                                    'buttonName' => '选择',
                                    'buttonOptions' => ['type' => 'button', 'class' => 'btn btn-default'],
                                    'options' => ['class' => 'form-control', 'placeholder' => '请选择图片'],
                                    'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                                    'thumb' => 'original',
                                    'imageContainer' => '#js-picture-container-' . $containerId,
                                    'pasteData' => FileInput::DATA_ID,
                                ]) ?>
                            </div>
                            <div class="col-sm-2">
                                <button type="button" class="btn btn-danger col-sm-10 js-slide-delete">删除</button>
                            </div>
                        </div>

                        <div class="form-group" style="display: none;">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-10" id="#js-picture-container-<?= $containerId ?>">
                                <?php if (!$model->isNewRecord): ?>
                                    <?= Html::img($picture, ['title' => $model->name, 'width' => 150]) ?>
                                <?php endif; ?>
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
                    <div class="col-sm-3 text-center">
                        <?= Html::img($brand['logo'], ['width' => '75%']) ?>
                        <div class="help-block text-center">
                            <?= Html::radio('Book[brand_id]', $model->brand_id == $brand['id'], [
                                'value' => $brand['id'],
                                'label' => '&nbsp;&nbsp;' . $brand['name']
                            ]) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>

            <div role="tabpanel" class="tab-pane" id="messages">
                <?php foreach ($authors as $author): ?>
                    <div class="col-sm-3 text-center">
                        <?= Html::img($author['logo'], ['width' => '75%', 'height' => 150]) ?>
                        <div class="help-block text-center">
                            <?= Html::checkbox('Book[author_id][]', isset($bookAuthors[$author['id']]), [
                                'value' => $author['id'],
                                'label' => '&nbsp;&nbsp;' . $author['name']
                            ]) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('System', 'Create') : Yii::t('System', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php $this->registerJsFile('@web/js/goods.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>

<?php $this->registerJs(


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