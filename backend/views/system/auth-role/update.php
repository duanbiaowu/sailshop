<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthRole */
/* @var $menus */
/* @var $manageOpt */
/* @var $roleMenus */

$this->title = Yii::t('System', 'Update') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Auth Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('System', 'Update');
?>
<div class="auth-role-update">

    <?= $this->render('_form', [
        'model' => $model,
        'menus' => $menus,
        'manageOpt' => $manageOpt,
        'roleMenus' => $roleMenus,
    ]) ?>

</div>
