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
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status')->dropDownList(Order::formatStatus()) ?>

    <?= $form->field($model, 'express_type')->dropDownList(
            ArrayHelper::map(ExpressCompany::find()->asArray()->all(), 'id', 'name')
    ) ?>

    <?= $form->field($model, 'express_code')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
