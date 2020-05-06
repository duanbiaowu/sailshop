<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\content\ArticleContent */
/* @var array $categories */

$this->title = '更新文章' . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => '所有文章', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = '更新';
?>
<div class="article-content-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
