<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthRole */
/* @var $menus */
/* @var $manageOpt */
/* @var $roleMenus */

$this->title = Yii::t('System', 'Create Auth Role');
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Auth Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-role-create">

    <?= $this->render('_form', [
        'model' => $model,
        'menus' => $menus,
        'manageOpt' => $manageOpt,
        'roleMenus' => $roleMenus,
    ]) ?>

</div>
