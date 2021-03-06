<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2015-11-06
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '其它设置';
$this->params['breadcrumbs'][] = $this->title;

?>

<?= $this->render('_label') ?>

<?php $form = ActiveForm::begin([
    'id' => 'other-form',
    'options' => ['class' => 'form-horizontal'],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-4">{input}{error}{hint}</div>',
    ],
]); ?>

    <div class="panel panel-default">
        <div class="panel-heading">
            请设置站点其它信息
        </div>
        <div class="panel-body">
            <?= $form->field($model, 'currencySymbol')->hint('请输入系统通用货币符号'); ?>

            <?= $form->field($model, 'currencyUnit')->hint('请输入系统通用货币单位'); ?>

            <?= $form->field($model, 'taxRate')->hint('请输入系统交易税率'); ?>

            <?= $form->field($model, 'invoice', [
                'template' => '{label} <div class="col-sm-4"><label class="checkbox-inline">{input}开启</label>{error}{hint}</div>',
            ])->hint('请选择系统是否开启发票功能')->checkbox([], false); ?>

            <?= $form->field($model, 'orderDelay')->hint('请输入默认订单作废时长，从订单生成时间开始算起'); ?>

        </div>
    </div>

    <div class="form-group col-sm-12">
        <?= Html::submitButton('提交', ['class' => 'btn btn-primary col-sm-1']); ?>
    </div>

<?php ActiveForm::end(); ?>
