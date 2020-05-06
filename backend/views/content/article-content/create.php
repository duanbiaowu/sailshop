<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\content\ArticleContent */
/* @var array $categories */

$this->title = '创建文章';
$this->params['breadcrumbs'][] = ['label' => '全部文章', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="article-content-create">

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>

</div>
