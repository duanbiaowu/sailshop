<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\content\ArticleCategory */
/* @var array $categories */

$this->title = '创建文章分类';
$this->params['breadcrumbs'][] = ['label' => '文章分类', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-category-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
