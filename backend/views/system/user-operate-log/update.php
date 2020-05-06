<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\system\UserOperateLog */

$this->title = 'Update User Operate Log: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Operate Logs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-operate-log-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
