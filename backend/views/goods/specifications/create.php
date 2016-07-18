<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\goods\Specifications */

$this->title = Yii::t('Goods', 'Create Specifications');
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'Specifications'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="specifications-create">
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
