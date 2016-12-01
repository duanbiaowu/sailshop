<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthRule */

$this->title = Yii::t('System', 'Update') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Auth Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('System', 'Update');
?>
<div class="auth-rule-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
