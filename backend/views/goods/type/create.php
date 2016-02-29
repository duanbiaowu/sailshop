<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\goods\Type */

$this->title = Yii::t('Goods', 'create_type');
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
