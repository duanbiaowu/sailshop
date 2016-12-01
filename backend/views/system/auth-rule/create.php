<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthRule */

$this->title = Yii::t('System', 'Create Auth Rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Auth Rules'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-rule-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
