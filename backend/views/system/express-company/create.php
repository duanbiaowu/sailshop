<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\system\ExpressCompany */

$this->title = '创建快递公司';
$this->params['breadcrumbs'][] = ['label' => '快递公司', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="express-company-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
