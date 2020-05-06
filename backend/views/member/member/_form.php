<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\system\User */
/* @var $form yii\widgets\ActiveForm */
/* @var $roles */
?>


<?php $form = ActiveForm::begin([
    'id' => 'user-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
    ],
]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Yii::t('System', 'Set User Info') ?>
    </div>

    <div class="panel-body">

    <?php if ($model->isNewRecord): ?>
    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
    <?php else: ?>
    <div class="form-group field-user-username required">
        <label class="col-sm-2 control-label"><?= Yii::t('System', 'Username'); ?></label>
        <div class="col-sm-8 form-control-static">
            <strong class="text-primary"><?= $model->username ?></strong>
        </div>
    </div>
    <?php endif; ?>

    <?= $form->field($model, 'nickname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['value' => '', 'maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->radioList($model->statusLabel(), [
        'item' => function($index, $label, $name, $checked, $value) {
            return Html::radio($name, $checked, ['value' => $value, 'label' => $label, 'labelOptions' => ['class' => 'radio-inline']]);
        }
    ]) ?>

    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('System', 'Create') : Yii::t('System', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

