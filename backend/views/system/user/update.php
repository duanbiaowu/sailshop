<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\system\User */
/* @var $roles */

$this->title = Yii::t('System', 'Update') . ' ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('System', 'Update');
?>
<div class="user-update">

    <?= $this->render('_form', [
        'model' => $model,
        'roles' => $roles,
    ]) ?>

</div>
