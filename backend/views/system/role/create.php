<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\system\Role */

$this->title = Yii::t('System', 'Create Role');
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="role-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
