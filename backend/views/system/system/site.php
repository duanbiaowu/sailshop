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

$this->title = '站点设置';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="panel panel-default">
    <div class="panel-heading">
        请设置站点基本信息
    </div>
    <div class="panel-body">
    <?php $form = ActiveForm::begin([
        'id' => 'site-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'labelOptions' => ['class' => 'col-sm-2 control-label'],
            'template' => '{label} <div class="col-sm-8">{input}{error}{hint}</div>',
        ],
    ]); ?>

        <?= $form->field($model, 'siteName'); ?>

        <?= $form->field($model, 'siteLogo'); ?>

        <?= $form->field($model, 'keyword'); ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 3]); ?>

        <?= $form->field($model, 'siteIcp'); ?>

        <?= $form->field($model, 'siteUrl'); ?>

        <?= $form->field($model, 'email'); ?>

        <?= $form->field($model, 'mobile'); ?>

        <?= $form->field($model, 'zip'); ?>

        <?= $form->field($model, 'address'); ?>

        <?= $form->field($model, 'updated_at')->label('')->hiddenInput(['value' => time()]); ?>

    </div>
</div>

<div class="form-group">
    <?= Html::submitButton('提交', ['class' => 'btn btn-primary col-sm-1']); ?>
</div>

<?php ActiveForm::end(); ?>