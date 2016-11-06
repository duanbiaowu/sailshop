<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Specifications */
/* @var $form yii\widgets\ActiveForm */
/* @var $items */
?>

<?php $form = ActiveForm::begin([
    'id' => 'specifications-form',
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
        请设置商品规格信息
    </div>
    <div class="panel-body">

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <div id="js-spec-values-container">
            <div class="form-group">
                <label class="col-sm-2 control-label">规格值</label>
                <div class="col-sm-8">
                    <button type="button" id="js-spec-create" class="btn btn-default col-sm-2">添加</button>
                </div>
            </div>

            <?php if ($items): ?>
                <?php foreach ($items as $index => $item): ?>
                    <div class="form-group">
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-3">
                            <input type="text" name="items[]" class="form-control" value="<?= $item->name ?>" placeholder="请输入规格值" />
                        </div>

                        <div class="col-sm-5">
                            <?php echo FileInput::widget([
                                'name' => 'images[]',
                                'value' => $item->images,
                                'buttonTag' => 'button',
                                'buttonName' => '选择',
                                'buttonOptions' => ['type' => 'button', 'class' => 'btn btn-default'],
                                'options' => ['class' => 'form-control', 'placeholder' => '请选择规格对应图片'],
                                'template' => '<div class="input-group">{input}<span class="input-group-btn">{button}</span></div>',
                                'thumb' => 'original',
                                'imageContainer' => '.img',
                                'pasteData' => FileInput::DATA_ID,
                            ]) ?>
                        </div>

                        <div class="col-sm-2">
                            <button type="button" class="btn btn-danger col-sm-10 js-spec-delete">删除</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <?= $this->render('_item_form'); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('Goods', 'Create') : Yii::t('Goods', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php $this->registerJs(
<<<EOF
    $('#js-spec-create').on('click', function() {
        $.post('item-form', {}, function(response) {
            $('#js-spec-values-container').append(response);
        });
    });

    $('#js-spec-values-container').delegate('.js-spec-delete', 'click', function() {
        $(this).parent().parent().remove();
    });

    $('#specifications-parent_id').change(function() {
        if ($(this).val() > 0) {
            $('#js-spec-values-container').show();
        } else {
            $('#js-spec-values-container').hide();
        }
    });
EOF
); ?>
