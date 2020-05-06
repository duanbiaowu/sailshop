<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\system\ExpressCompany */

$this->title = '更新: ' . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => '快递公司', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="express-company-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
