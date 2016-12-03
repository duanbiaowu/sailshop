<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthMenu */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories */

?>

<?php $form = ActiveForm::begin([
    'id' => 'auth-menu-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
    ],
]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('System', 'Set Menu Info') ?>
    </div>

    <div class="panel-body">

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="form-group field-authmenu-parent_id">
        <label class="col-sm-2 control-label">上级菜单</label>
        <div class="col-sm-8">
            <select class="form-control" name="AuthMenu[parent_id]">
                <option value="0" selected><?= Yii::t('System', 'Top Menu Name') ?></option>
                <?php foreach ($categories as $category): ?>
                    <option value="<?= $category['id'] ?>" <?php if ($model->parent_id == $category['id']): ?>selected<?php endif; ?>><?= $category['name'] ?></option>
                    <?php foreach ($category['children'] as $child): ?>
                        <option value="<?= $child['id'] ?>" <?php if ($model->parent_id == $child['id']): ?>selected<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;<?= $child['name'] ?></option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <?= $form->field($model, 'route')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>

    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('System', 'Create') : Yii::t('System', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>


