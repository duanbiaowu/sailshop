<?php

use pendalf89\filemanager\widgets\FileInput;

?>

<div class="form-group">
    <label class="col-sm-2 control-label"></label>
    <div class="col-sm-6">
        <?php echo FileInput::widget([
            'id' => 'item-' . mt_rand(1, 102400),
            'name' => 'Goods[show_pictures][]',
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
