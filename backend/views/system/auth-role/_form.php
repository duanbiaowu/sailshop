<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthRole */
/* @var $form yii\widgets\ActiveForm */
/* @var $menus */
/* @var $manageOpt */
/* @var $roleMenus */
?>

<?php $form = ActiveForm::begin([
    'id' => 'auth-role-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
    ],
]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('System', 'Set Role Info') ?>
    </div>

    <div class="panel-body">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <label class="col-sm-2 control-label"><?= Yii::t('System', 'Auth Role Permission') ?></label>
            <div class="col-sm-10">
                <ul class="nav nav-tabs" role="tablist">
                    <?php foreach ($menus as $index => $menu): ?>
                    <li role="presentation" <?php if ($index == 0): ?>class="active"<?php endif; ?>>
                        <a href="#js-menu-<?= $index ?>" role="tab" data-toggle="tab"><?= $menu['name'] ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>

                <div class="tab-content">
                    <?php foreach ($menus as $index => $menu): ?>
                    <div role="tabpanel" class="tab-pane <?php if ($index == 0): ?>active<?php endif; ?>" id="js-menu-<?= $index ?>">
                        <div class="form-group"></div>
                        <div class="form-group">
                            <div class="col-sm-10">
                                <?php foreach ($menu['children'] as $child): ?>
                                <div class="list-group">
                                    <a href="javascript:;" class="list-group-item disabled">
                                        <?= $child['name'] ?>
                                    </a>
                                    <?php foreach ($child['children'] as $item): ?>
                                    <a href="javascript:;" class="list-group-item">
                                        <?= $item['name'] ?>
                                        <div class="col-sm-10 pull-right">
                                            <div class="col-sm-3">
                                                <label class="text-primary pull-right">
                                                    <input type="checkbox" class="js-operation-all" <?php if (isset($roleMenus[$item['id']]['operation']) && $roleMenus[$item['id']]['operation'] == $manageOpt): ?>checked<?php endif; ?>>&nbsp;&nbsp;<?= Yii::t('System', 'Check All'); ?>
                                                </label>
                                            </div>
                                            <div class="col-sm-9">
                                                <?php foreach ($model->operations() as $key => $operation): ?>
                                                <label class="col-sm-3">
                                                    <input type="checkbox" name="operation[<?= $menu['id'] ?>][<?= $child['id'] ?>][<?= $item['id'] ?>][]"
                                                           class="js-operation-single" value="<?= $key ?>"
                                                           <?php if (isset($roleMenus[$item['id']]['operation']) && ($key & $roleMenus[$item['id']]['operation'])): ?>checked<?php endif; ?>
                                                    >&nbsp;&nbsp;<?= $operation ?>
                                                </label>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </a>
                                    <?php endforeach; ?>
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
</div>



<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('System', 'Create') : Yii::t('System', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php $this->registerJs(
    <<<EOF
    $('.js-operation-all').on('click', function() {
        $(this).parent().parent().next().find('input').prop('checked', $(this).prop('checked'));
    });
    
    $('.js-operation-single').on('click', function() {
        var checked = true;
        var container = $(this).parent().parent();
        container.find('input').each(function() {
            if (false === $(this).prop('checked')) {
                checked = false;
                return false;
            } 
        });
        container.prev().find('input').prop('checked', checked);
    });
EOF
) ?>
