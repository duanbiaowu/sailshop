<?php
/**
 * @name Launch shop system
 * @copyright Copyright (c) 2015-2099
 * @author: 游梦惊园
 * @blog: www.codean.net
 * @version 1.0
 * @date: 2015-11-06
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '站点设置';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
    <?php $form = ActiveForm::begin(['id' => 'site-form', 'options' => ['class' => 'form-horizontal']]); ?>

        <?= $form->field($model, 'siteName', [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
        ]); ?>

        <?= $form->field($model, 'siteLogo', [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
        ]); ?>

        <?= $form->field($model, 'keyword', [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
        ]); ?>

        <?= $form->field($model, 'description', [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
        ])->textarea(['rows' => 3]); ?>

        <?= $form->field($model, 'siteIcp', [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
        ]); ?>

        <?= $form->field($model, 'siteUrl', [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
        ]); ?>

        <?= $form->field($model, 'email', [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
        ]); ?>

        <?= $form->field($model, 'mobile', [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
        ]); ?>

        <?= $form->field($model, 'zip', [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
        ]); ?>

        <?= $form->field($model, 'address', [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
        ]); ?>

        <?= $form->field($model, 'updated_at')->label('')->hiddenInput(['value' => time()]); ?>

    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('提交', ['class' => 'btn btn-primary col-sm-1']); ?>
</div>

<?php ActiveForm::end(); ?>