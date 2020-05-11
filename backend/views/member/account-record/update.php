<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\MemberAccountRecord */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Member Account Record',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Member Account Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="member-account-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
