<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\system\User */
/* @var $roles */

$this->title = Yii::t('System', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <?= $this->render('_form', [
        'model' => $model,
        'roles' => $roles,
    ]) ?>

</div>
