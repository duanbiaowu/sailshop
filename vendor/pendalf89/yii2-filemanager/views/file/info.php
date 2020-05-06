<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use pendalf89\filemanager\assets\FilemanagerAsset;
use pendalf89\filemanager\Module;

/* @var $this yii\web\View */
/* @var $model pendalf89\filemanager\models\Attachment */
/* @var $form yii\widgets\ActiveForm */

$bundle = FilemanagerAsset::register($this);
?>

<div class="form-group row">
    <div class="col-sm-4">
    <?= Html::img($this->context->module->routes['baseUrl'] . $model->path) ?>
    </div>
    <div class="col-sm-8">
        <p><?= Module::t('main', 'file_upload_date') . $model->year . '-' . $model->month . '-' . $model->day ?></p>
        <p><?= Module::t('main', 'file_size') . $model->getFileSize() ?></p>
    </div>
</div>

<div class="form-group row">
    <div class="col-sm-6">
    <?php $form = ActiveForm::begin(['options' => ['id' => 'control-form']]); ?>

    <?= Html::hiddenInput('path', $model->path) ?>
    <?= Html::hiddenInput('url', $this->context->module->routes['baseUrl'] . $model->path, ['data-ee' => 'duanbiaowu']) ?>

    <?= Html::button(Module::t('main', 'select_file'), [
        'id' => 'insert-btn', 'class' => 'btn btn-success btn-sm col-sm-12']
    ) ?>

    <?php ActiveForm::end(); ?>
    </div>

    <div class="col-sm-6">
        <?= Html::a(Module::t('main', 'Delete'), ['file/delete/', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm col-sm-12',
            'data-confirm' => Yii::t('System', 'common_delete_confirm'),
            'data-id' => $model->id,
            'role' => 'delete',
        ]) ?>
    </div>
</div>

