<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-12-16
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '运行SQL语句';
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_label'); ?>

<?php $form = ActiveForm::begin([
    'id' => 'sql-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-1 control-label'],
        'template' => '{label} <div class="col-sm-9">{input}{error}{hint}</div>',
    ],
]); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <?= Html::encode($this->title) ?>
    </div>
    <div class="panel-body">
        <?= $form->field($model, 'sql')->textarea(['rows' => 8])->hint('请输入需要执行的SQL语句，请充分了解语句的执行结果'); ?>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton('提交', ['class' => 'btn btn-primary col-sm-1']); ;?>
</div>

<?php ActiveForm::end(); ?>
