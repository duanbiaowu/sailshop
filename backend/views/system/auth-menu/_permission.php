<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthMenu */
/* @var $form yii\widgets\ActiveForm */
/* @var array $permissions */

$this->title = $model->name . ' ' . Yii::t('System', '权限设置: ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Auth Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '权限设置';

?>

<?php $form = ActiveForm::begin([
    'id' => 'auth-menu-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
    ],
]); ?>

<div class="panel panel-default" id="js-menu-permission" v-cloak="">
    <div class="panel-heading">
        请设置菜单权限
    </div>

    <div class="panel-body">
        <div class="form-group">
            <div class="col-sm-8">
                <button type="button" class="btn btn-default" v-on:click="add">添加权限</button>
            </div>
        </div>
        <div class="form-group" v-for="value in values">
            <div class="col-sm-3">
                <input type="input" name="name[]" v-model="value.name" class="form-control" placeholder="请输入权限名称" required>
            </div>
            <div class="col-sm-3">
                <input type="input" name="method[]" v-model="value.method"  class="form-control" placeholder="请输入权限方法" required>
            </div>
            <div class="col-sm-3">
                <input type="input" name="query[]" v-model="value.query"  class="form-control" placeholder="请输入权限参数">
            </div>
            <div class="col-sm-2">
                <button type="button" class="btn btn-danger btn-sm" v-on:click="remove($index)">删除</button>
            </div>
        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('System', 'Create') : Yii::t('System', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php $this->registerJsFile('@web/js/permission.js', [
    'depends' => backend\assets\AppAsset::className()
]) ?>

<?php $this->registerJs(
    '
    Permission.setMenuId(' . $model->id . ');
    Permission.setValues(' . json_encode($permissions, true) . ');
    '
); ?>
