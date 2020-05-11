<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\MemberAccountRecord */

$this->title = Yii::t('app', 'Create Member Account Record');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Member Account Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="member-account-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
