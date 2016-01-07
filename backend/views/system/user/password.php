<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-10-28
 */

$this->title = '帐号设置';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<?php $form = ActiveForm::begin(['id' => 'reset-password-form', 'options' => ['class' => 'form-horizontal']]); ?>
<div class="panel panel-default">
    <div class="panel-heading">
        请输入原始密码和新密码进行密码修改操作
    </div>
    <div class="panel-body">
        <div class="col-sm-12">
            <?= $form->field($model, 'password', [
                'labelOptions' => ['class' => 'col-sm-1 control-label'],
                'template' => '{label} <div class="col-sm-5">{input}{error}{hint}</div>'
            ])->passwordInput(['placeholder' => '请输入帐号的原始密码']) ?>

            <?= $form->field($model, 'new_password', [
                'labelOptions' => ['class' => 'col-sm-1 control-label'],
                'template' => '{label} <div class="col-sm-5">{input}{error}{hint}</div>'
            ])->passwordInput(['placeholder' => '请输入帐号的新密码']) ?>

            <?= $form->field($model, 'repeat_password', [
                'labelOptions' => ['class' => 'col-sm-1 control-label'],
                'template' => '{label} <div class="col-sm-5">{input}{error}{hint}</div>'
            ])->passwordInput(['placeholder' => '请再次输入帐号的新密码']) ?>

        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton('修改密码', ['class' => 'btn btn-primary col-sm-1']) ?>
</div>
<?php ActiveForm::end(); ?>
