<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\system\AuthItem */

$this->title = Yii::t('System', 'Create Auth Item');
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Auth Items'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
