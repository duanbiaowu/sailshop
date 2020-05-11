<?php

use backend\models\system\ExpressCompany;
use common\models\order\Order;
use common\models\system\PaymentType;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\order\Order */
/* @var $form yii\widgets\ActiveForm */
/* @var string $redirect */


?>

<?php $form = ActiveForm::begin(); ?>

<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">设置协商信息</h4>
        </div>
        <div class="modal-body">
            <?= Html::dropDownList('status', null, [
                '1' => '已完成',
                '0' => '未完成',
            ], [
                'class' => 'form-control'
            ]) ?>

        </div>
        <div class="modal-footer">
            <?= Html::submitButton('确认提交', ['class' => 'btn btn-default']) ?>
            <?= Html::hiddenInput('redirect', $redirect) ?>
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        </div>
    </div>
</div>


<?php ActiveForm::end(); ?>