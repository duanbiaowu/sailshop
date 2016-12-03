<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthMenu */
/* @var $categories */

$this->title = Yii::t('System', 'Create Auth Menu');
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Auth Menus'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-menu-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
