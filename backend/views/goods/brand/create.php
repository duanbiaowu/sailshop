<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\goods\Brand */

$this->title = Yii::t('Goods', 'create_brand');
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'brands'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
