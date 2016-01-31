<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\goods\Attribute */

$this->title = Yii::t('System', 'Create Attribute');
$this->params['breadcrumbs'][] = ['label' => Yii::t('System', 'Attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
