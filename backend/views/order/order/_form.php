<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\order\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'member_id')->textInput() ?>

    <?= $form->field($model, 'price_count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'finish_time')->textInput() ?>

    <?= $form->field($model, 'pay_type')->textInput() ?>

    <?= $form->field($model, 'pay_time')->textInput() ?>

    <?= $form->field($model, 'express_type')->textInput() ?>

    <?= $form->field($model, 'express_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'remark')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'province_id')->textInput() ?>

    <?= $form->field($model, 'province_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'city_id')->textInput() ?>

    <?= $form->field($model, 'city_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'district_id')->textInput() ?>

    <?= $form->field($model, 'district_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'zip_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'detail_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'create_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
