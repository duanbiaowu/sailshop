<?php
/**
 * @name: SailShop System
 * @author: 游梦惊园
 * @link: https://github.com/duanbiaowu/sailshop
 * @blog: http://www.cnblogs.com/duanbiaowu
 * @copyright: Copyright (c) 2016 SailShop System
 * @date: 2016-01-20
 */

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\system\Region */
/* @var $provinces */

?>

<?php $form = ActiveForm::begin([
    'id' => 'region-form',
    'options' => ['class' => 'form-horizontal'],
]); ?>

<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?= $model->isNewRecord ? '创建区域' : '编辑区域' ?></h4>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <?= $form->field($model, 'name', [
                    'labelOptions' => ['class' => 'control-label col-sm-2'],
                    'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
                ]); ?>

                <?= $form->field($model, 'provinces', [
                    'template' => '<div class="col-sm-12">{input}</div><div class="col-sm-12"><div class="col-sm-12">{error}</div></div>',
                ])->checkboxList(ArrayHelper::map($provinces, 'id', 'name'), [
                    'item' => function($index, $label, $name, $checked, $value) {
                        $html = '<div class="col-sm-2 help-block">';
                        $html .= Html::checkbox($name, $checked, ['label' => $label, 'value' => $value, 'labelOptions' => ['class' => 'checkbox-inline']]);
                        $html .= '</div>';
                        return $html;
                    }
                ]) ?>

            </div>
            <div class="alert alert-info">
                请选择区域所包含的省份
            </div>
        </div>

        <div class="modal-footer">
            <?= Html::submitButton('确认提交', ['class' => 'btn btn-success']) ?>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>





