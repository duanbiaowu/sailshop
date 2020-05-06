<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\system\Role */
/* @var $form yii\widgets\ActiveForm */
/* @var array $menus */
/* @var array $permissions */

?>

<?php $form = ActiveForm::begin([
    'id' => 'role-form',
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
        请设置角色信息
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
                                                <a href="javascript:;" class="list-group-item"
                                                    <?php if (isset($item['permissions']) && count($item['permissions']) > 2): ?> style="height: <?= ceil(count($item['permissions']) / 2) * 40 ?>px"<?php endif; ?>>
                                                    <?= $item['name'] ?>

                                                    <?php if (isset($item['permissions'])): ?>
                                                    <div class="col-sm-10 pull-right">
                                                        <div class="col-sm-3">
                                                            <label class="text-primary pull-right">
                                                                <input type="checkbox" class="js-operation-all">&nbsp;&nbsp;
                                                                <?= Yii::t('System', 'Check All'); ?>
                                                            </label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <?php foreach ($item['permissions'] as $permission): ?>
                                                                <label class="col-sm-6">
                                                                    <input type="checkbox" name="permissionIds[]"
                                                                           class="js-operation-single" value="<?= $permission['id'] ?>"
                                                                           <?php if (isset($permissions[$permission['id']])): ?>checked<?php endif; ?>>
                                                                    <?= $permission['name'] ?>
                                                                </label>
                                                            <?php endforeach; ?>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
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
    <?= Html::submitButton($model->isNewRecord ? Yii::t('System', 'Create') : Yii::t('System', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
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
    
    $('.js-operation-all').each(function() {
        var checked = true;
        var container = $(this);
        
        $(this).parent().parent().next().find('input').each(function() {
            if (false === $(this).prop('checked')) {
                checked = false;
                return false;
            } 
        });
        $(this).prop('checked', checked);
    });
EOF
) ?>

