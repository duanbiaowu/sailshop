<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\system\Role */
/* @var array $menus */
/* @var array $permissions */

$this->title = Yii::t('System', 'Update') . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('System', 'Update');
?>
<div class="role-update">
    <?= $this->render('_form', [
        'model' => $model,
        'menus' => $menus,
        'permissions' => $permissions,
    ]) ?>
</div>
