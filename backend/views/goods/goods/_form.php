<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\goods\Goods */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'id' => 'attribute-form',
    'options' => [
        'class' => 'form-horizontal',
    ],
    'fieldConfig' => [
        'labelOptions' => ['class' => 'col-sm-2 control-label'],
        'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
    ],
]); ?>

<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active">
        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
            <?= Yii::t('Goods', 'Goods Form Basic') ?>
        </a>
    </li>

    <?php if ($model->isNewRecord): ?>
    <li role="presentation">
        <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
            <?= Yii::t('Goods', 'Goods Form Brand') ?>
        </a>
    </li>
    <li role="presentation">
        <a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">
            <?= Yii::t('Goods', 'Goods Form Sku') ?>
        </a>
    </li>
    <li role="presentation">
        <a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
            <?= Yii::t('Goods', 'Goods Form Seo') ?>
        </a>
    </li>
    <?php endif; ?>
</ul>

<div class="form-group"></div>

<div class="panel panel-default">
    <div class="panel-body">
        <div class="tab-content">

            <div role="tabpanel" class="tab-pane active" id="home">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'category_id')->textInput() ?>

                <?= $form->field($model, 'brand_id')->textInput() ?>

                <?= $form->field($model, 'unit')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'thumbnail')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'attributes')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'show_pictures')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'seo_title')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'seo_keyword')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'seo_description')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'status')->textInput() ?>
            </div>

            <div role="tabpanel" class="tab-pane" id="profile">
                <?= Yii::t('Goods', 'Goods Form Brand') ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="messages">
                <?= Yii::t('Goods', 'Goods Form Sku') ?>
            </div>
            <div role="tabpanel" class="tab-pane" id="settings">
                <?= Yii::t('Goods', 'Goods Form Seo') ?>
            </div>

        </div>
    </div>
</div>

<div class="form-group col-sm-12">
    <?= Html::submitButton($model->isNewRecord ? Yii::t('Goods', 'Create') : Yii::t('Goods', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success col-sm-1' : 'btn btn-primary col-sm-1']) ?>
</div>

<?php ActiveForm::end(); ?>

