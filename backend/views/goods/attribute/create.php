<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\goods\Attribute */

$this->title = Yii::t('Goods', 'create_attribute');
$this->params['breadcrumbs'][] = ['label' => Yii::t('Goods', 'attributes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attribute-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
