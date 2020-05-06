<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\content\ArticleCategory */
/* @var array $categories */

$this->title = '更新文章分类';
$this->params['breadcrumbs'][] = ['label' => '文章分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="article-category-update">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
