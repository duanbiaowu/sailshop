<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

/* @var $specs */
?>

<?php $form = ActiveForm::begin([
    'id' => 'region-form',
    'options' => ['class' => 'form-horizontal'],
]); ?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?= Yii::t('Goods', 'Goods Form Sku Select') ?></h4>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <div class="col-sm-3">
                    <ul class="list-group">
                        <?php foreach ($specs as $spec): ?>
                        <a href="#js-spec-group-<?= $spec['id'] ?>" class="list-group-item" data-toggle="tab" aria-expanded="false">
                            <span class="badge">0</span>
                            <?= $spec['name'] ?>
                        </a>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <div class="col-sm-9">
                    <div class="tab-content">
                        <?php foreach ($specs as $spec): ?>
                        <div class="tab-pane fade <?php if ($spec['id'] == array_keys($specs)[0]) echo 'in active';?>" id="js-spec-group-<?= $spec['id'] ?>">
                            <div class="panel panel-default">
                                <div class="panel-heading"><?= $spec['name'] ?></div>
                                <div class="panel-body">
                                    <?php foreach ($spec['children'] as $child): ?>
                                    <div class="col-sm-3 help-block">
                                        <label class="checkbox-inline">
                                            <input type="checkbox" name="" value="" />
                                            <?= $child['name'] ?>
                                        </label>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <?= Html::button('生成规格表格', ['class' => 'btn btn-default', 'onClick' => 'Goods.skuSelector()']) ?>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

