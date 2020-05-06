<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthMenu */
/* @var $categories */

$this->title = Yii::t('System', 'Update') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Auth Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('System', 'Update');
?>
<div class="auth-menu-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
