<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\goods\Author */

$this->title = '创建作者';
$this->params['breadcrumbs'][] = ['label' => '作者管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brand-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
