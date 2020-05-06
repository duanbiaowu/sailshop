<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\goods\BookSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'isbn') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'brand_id') ?>

    <?= $form->field($model, 'thumbnail') ?>

    <?php // echo $form->field($model, 'show_pictures') ?>

    <?php // echo $form->field($model, 'translator') ?>

    <?php // echo $form->field($model, 'pages') ?>

    <?php // echo $form->field($model, 'binding') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'publish_date') ?>

    <?php // echo $form->field($model, 'introduce') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'stock') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'modified_time') ?>

    <?php // echo $form->field($model, 'create_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
